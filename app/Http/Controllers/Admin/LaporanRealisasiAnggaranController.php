<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanRealisasiRequest;
use App\Models\LaporanRealisasiAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LaporanRealisasiAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        $query = LaporanRealisasiAnggaran::query();

        if ($search) {
            $query->search($search);
        }

        if ($bulan) {
            $query->byMonth($bulan, $tahun);
        } elseif ($tahun) {
            $query->byYear($tahun);
        }

        $laporans = $query->latest()->paginate(15)->appends($request->all());

        // Statistik
        $totalAnggaran = LaporanRealisasiAnggaran::sum('anggaran');
        $totalRealisasi = LaporanRealisasiAnggaran::sum('realisasi');
        $totalPersen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 1) : 0;

        return view('admin.laporan-realisasi.index', compact(
            'laporans', 'totalAnggaran', 'totalRealisasi', 'totalPersen'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laporan-realisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaporanRealisasiRequest $request)
    {
        try {
            $validated = $request->validated();

            // Handle file uploads
            $filePendukung = [];
            if ($request->hasFile('file_pendukung')) {
                foreach ($request->file('file_pendukung') as $file) {
                    $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $filename .= '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('laporan-realisasi', $filename, 'public');
                    $filePendukung[] = $path;
                }
            }
            $validated['file_pendukung'] = !empty($filePendukung) ? json_encode($filePendukung) : null;

            LaporanRealisasiAnggaran::create($validated);

            return redirect()
                ->route('admin.laporan-realisasi.index')
                ->with('success', 'Laporan Realisasi Anggaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporan = LaporanRealisasiAnggaran::findOrFail(decrypt($id));
        return view('admin.laporan-realisasi.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laporan = LaporanRealisasiAnggaran::findOrFail(decrypt($id));
        return view('admin.laporan-realisasi.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaporanRealisasiRequest $request, $id)
    {
        try {
            $laporan = LaporanRealisasiAnggaran::findOrFail(decrypt($id));
            $validated = $request->validated();

            // Handle file uploads (tambah file baru)
            if ($request->hasFile('file_pendukung')) {
                $existingFiles = json_decode($laporan->file_pendukung ?? '[]', true);
                
                foreach ($request->file('file_pendukung') as $file) {
                    $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $filename .= '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('laporan-realisasi', $filename, 'public');
                    $existingFiles[] = $path;
                }
                $validated['file_pendukung'] = json_encode($existingFiles);
            }

            $laporan->update($validated);

            return redirect()
                ->route('admin.laporan-realisasi.index')
                ->with('success', 'Laporan Realisasi Anggaran berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $laporan = LaporanRealisasiAnggaran::findOrFail(decrypt($id));

            // Delete files
            if ($laporan->file_pendukung) {
                $files = json_decode($laporan->file_pendukung, true);
                foreach ($files as $file) {
                    if (Storage::disk('public')->exists($file)) {
                        Storage::disk('public')->delete($file);
                    }
                }
            }

            $laporan->delete();

            return redirect()
                ->route('admin.laporan-realisasi.index')
                ->with('success', 'Laporan Realisasi Anggaran berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    /**
     * Delete single file from existing laporan
     */
    public function deleteFile($id, $fileIndex)
    {
        try {
            $laporan = LaporanRealisasiAnggaran::findOrFail(decrypt($id));
            
            $files = json_decode($laporan->file_pendukung ?? '[]', true);
            
            if (isset($files[$fileIndex])) {
                // Delete file from storage
                if (Storage::disk('public')->exists($files[$fileIndex])) {
                    Storage::disk('public')->delete($files[$fileIndex]);
                }
                
                // Remove from array
                unset($files[$fileIndex]);
                $files = array_values($files); // Re-index array
                
                $laporan->update(['file_pendukung' => json_encode($files)]);
            }

            return back()->with('success', 'File berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus file: ' . $th->getMessage());
        }
    }
}

