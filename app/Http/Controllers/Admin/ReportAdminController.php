<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\User;
use App\Notifications\LaporanAkhirDiverifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportAdminController extends Controller
{
    // public function index()
    // {
    //     $laporans = LaporanAkhir::with(['user', 'verifiedBy'])
    //         ->latest()
    //         ->paginate(20); // Tambahkan pagination
        
    //     return view('admin.reports.index', ['laporans' => $laporans]);
    // }
    public function index(Request $request)
    {
        $query = LaporanAkhir::with(['user', 'verifiedBy']);

        // Filter by tab
        $tab = $request->get('tab', 'semua');
        if ($tab !== 'semua') {
            $query->filterByTab($tab);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                  ->orWhere('jenis_kegiatan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status (hanya jika tab = 'semua')
        if ($tab === 'semua' && $request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by year
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun_pelaksanaan', $request->tahun);
        }

        $laporans = $query->latest()->paginate(20)->appends($request->all());
        
        // Get unique years for filter dropdown
        $tahunList = LaporanAkhir::distinct()
            ->pluck('tahun_pelaksanaan')
            ->sort()
            ->values();
        
        return view('admin.reports.index', [
            'laporans' => $laporans,
            'tahunList' => $tahunList,
            'tab' => $tab,
        ]);
    }

    public function export(Request $request)
    {
        try {
            $fileName = 'laporan-akhir-kegiatan-' . date('Y-m-d-His') . '.xlsx';
            
            return Excel::download(
                new LaporanExport($request), 
                $fileName
            );
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal export data: ' . $th->getMessage());
        }
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function edit($id)
    {
        $decryptId = Crypt::decrypt($id);
        $laporan = LaporanAkhir::with('user')->findOrFail($decryptId);
        return view('admin.reports.edit', ['laporan' => $laporan]);
    }

    public function show($id)
    {
        $decryptId = Crypt::decrypt($id);
        $laporan = LaporanAkhir::with(['user', 'verifiedBy'])->findOrFail($decryptId);
        return view('admin.reports.show', ['laporan' => $laporan]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,revisi,ditolak',
            'catatan_admin' => 'required|string|min:10',
        ]);

        try {
            $decryptId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptId);
            
            $laporan->update([
                'status' => $request->status,
                'catatan_admin' => $request->catatan_admin,
                'tanggal_verifikasi' => now(),
                'verified_by' => Auth::id(),
            ]);

            // Kirim notifikasi ke user
            $laporan->user->notify(new LaporanAkhirDiverifikasi($laporan));

            return redirect()
                ->route('reports.admin.index')
                ->with('success', 'Status laporan berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal update status: ' . $th->getMessage());
        }
    }

    /**
     * Toggle publish status - admin can show/hide laporan di frontend
     */
    public function togglePublish($id)
    {
        try {
            $decryptId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptId);
            
            // Toggle publish status
            $laporan->is_published = !$laporan->is_published;
            $laporan->save();

            $message = $laporan->is_published 
                ? 'Laporan berhasil dipublikasikan dan akan ditampilkan di frontend' 
                : 'Laporan berhasil disembunyikan dari frontend';

            return redirect()
                ->back()
                ->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal update status publish: ' . $th->getMessage());
        }
    }

    /**
     * Bulk publish - publish multiple reports at once
     */
    public function bulkPublish(Request $request)
    {
        $request->validate([
            'laporan_ids' => 'required|array',
            'laporan_ids.*' => 'exists:laporan_akhirs,id',
        ]);

        try {
            $count = LaporanAkhir::whereIn('id', $request->laporan_ids)
                ->update(['is_published' => true]);

            return redirect()
                ->route('reports.admin.index')
                ->with('success', "$count laporan berhasil dipublikasikan");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mempublikasikan laporan: ' . $th->getMessage());
        }
    }

    /**
     * Bulk unpublish - hide multiple reports from frontend
     */
    public function bulkUnpublish(Request $request)
    {
        $request->validate([
            'laporan_ids' => 'required|array',
            'laporan_ids.*' => 'exists:laporan_akhirs,id',
        ]);

        try {
            $count = LaporanAkhir::whereIn('id', $request->laporan_ids)
                ->update(['is_published' => false]);

            return redirect()
                ->route('reports.admin.index')
                ->with('success', "$count laporan berhasil disembunyikan dari frontend");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menyembunyikan laporan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $decryptId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptId);
            
            // Hapus file jika ada
            if ($laporan->file_laporan && Storage::disk('public')->exists($laporan->file_laporan)) {
                Storage::disk('public')->delete($laporan->file_laporan);
            }
            
            if ($laporan->file_pendukung && Storage::disk('public')->exists($laporan->file_pendukung)) {
                Storage::disk('public')->delete($laporan->file_pendukung);
            }
            
            $laporan->delete();

            return redirect()
                ->route('reports.admin.index')
                ->with('success', 'Laporan berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus laporan: ' . $th->getMessage());
        }
    }

    /**
     * Toggle archive status - admin can archive/unarchive laporan
     */
    public function toggleArchive($id)
    {
        try {
            $decryptId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptId);
            
            // Toggle archive status
            $laporan->toggleArchive();

            if ($laporan->isArchived()) {
                $message = 'Laporan berhasil diarsipkan';
            } else {
                $message = 'Laporan berhasil dibuka dari arsip';
            }

            return redirect()
                ->back()
                ->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal update status arsip: ' . $th->getMessage());
        }
    }

    /**
     * Bulk archive - archive multiple reports at once
     */
    public function bulkArchive(Request $request)
    {
        $request->validate([
            'laporan_ids' => 'required|array',
            'laporan_ids.*' => 'exists:laporan_akhirs,id',
        ]);

        try {
            $count = 0;
            foreach ($request->laporan_ids as $id) {
                $laporan = LaporanAkhir::find($id);
                if ($laporan && !$laporan->isArchived()) {
                    $laporan->archive();
                    $count++;
                }
            }

            return redirect()
                ->route('reports.admin.index')
                ->with('success', "$count laporan berhasil diarsipkan");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengarsipkan laporan: ' . $th->getMessage());
        }
    }

    /**
     * Bulk unarchive - unarchive multiple reports at once
     */
    public function bulkUnarchive(Request $request)
    {
        $request->validate([
            'laporan_ids' => 'required|array',
            'laporan_ids.*' => 'exists:laporan_akhirs,id',
        ]);

        try {
            $count = 0;
            foreach ($request->laporan_ids as $id) {
                $laporan = LaporanAkhir::find($id);
                if ($laporan && $laporan->isArchived()) {
                    $laporan->unarchive();
                    $count++;
                }
            }

            return redirect()
                ->route('reports.admin.index', ['tab' => 'archived'])
                ->with('success', "$count laporan berhasil dibuka dari arsip");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal membuka arsip: ' . $th->getMessage());
        }
    }
}
