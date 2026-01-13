<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\LaporanRealisasiAnggaran;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tentang;

class FrontendController extends Controller
{
    /**
     * Landing Page - Home
     */
    public function home()
    {
        // Laporan yang sudah diterima DAN dipublikasikan - 6 items
        $beritaTerbaru = LaporanAkhir::with(['user'])
            ->where('is_draft', false)
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        // OPD Terbaru - 3 items (ambil OPD berdasarkan tanggal terbaru)
        $opdTerbaru = User::whereNotNull('nama_opd')
            ->latest()
            ->take(3)
            ->get();

        // Statistik
        $totalOpd = User::whereNotNull('nama_opd')->distinct()->count('nama_opd');
        $totalLaporan = LaporanAkhir::where('is_draft', false)->where('is_published', true)->count();
        $totalDiterima = LaporanAkhir::where('status', 'diterima')->where('is_published', true)->count();
        $tentangs = Tentang::active()->ordered()->get();

        return view('frondend.beranda.index', compact('beritaTerbaru', 'opdTerbaru', 'totalOpd', 'totalLaporan', 'totalDiterima', 'tentangs'));
    }

    /**
     * Data Page - Semua laporan (hanya yang dipublikasikan)
     */
    public function data(Request $request)
    {
        $query = LaporanAkhir::with(['user'])
            ->where('is_draft', false)
            ->where('is_published', true); // Hanya tampilkan yang dipublikasikan

        // Filter by OPD
        if ($request->has('opd') && $request->opd) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama_opd', 'like', '%' . $request->opd . '%');
            });
        }

        // Filter by tahun
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun_pelaksanaan', $request->tahun);
        }

        // Filter by jenis kegiatan
        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_kegiatan', $request->jenis);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Search by judul
        if ($request->has('search') && $request->search) {
            $query->where('judul_kegiatan', 'like', '%' . $request->search . '%');
        }

        $laporans = $query->latest()->paginate(12);
        
        // Get all OPD names from users table for filter
        $opds = User::whereNotNull('nama_opd')
            ->distinct()
            ->orderBy('nama_opd')
            ->get(['nama_opd']);
        
        // Get years for filter
        $tahuns = LaporanAkhir::distinct()
            ->pluck('tahun_pelaksanaan')
            ->sortDesc();

        // Get all statuses for filter
        $statuses = [
            'menunggu verifikasi' => 'Menunggu Verifikasi',
            'diterima' => 'Diterima',
            'revisi' => 'Revisi',
            'ditolak' => 'Ditolak',
        ];

        return view('frondend.data.index', compact('laporans', 'opds', 'tahuns', 'statuses'));
    }

    /**
     * Data Detail - Detail laporan lengkap
     */
    public function dataDetail($id)
    {
        try {
            $laporan = LaporanAkhir::with(['user', 'verifiedBy'])
                ->where('is_draft', false)
                ->findOrFail($id);

            return view('frondend.data.detail', compact('laporan'));
        } catch (\Exception $e) {
            return redirect()
                ->route('frontend.data')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * OPD Page - Daftar semua OPD dengan statistik
     */
    public function opd(Request $request)
    {
        // Get distinct users dengan nama_opd (ambil user pertama dari setiap OPD)
        $opdQuery = User::whereNotNull('nama_opd')
            ->select('id', 'nama_opd', 'name')
            ->distinct('nama_opd');

        // Search by nama opd
        if ($request->has('search') && $request->search) {
            $opdQuery->where(function($q) use ($request) {
                $q->where('nama_opd', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $opdUsers = $opdQuery->get();
        
        // Build collection with statistics - sekarang setiap item punya id
        $opdList = collect();
        foreach ($opdUsers as $user) {
            $displayName = $user->nama_opd ?: $user->name;
            $laporansCount = LaporanAkhir::whereHas('user', function($q) use ($displayName) {
                $q->where('nama_opd', $displayName);
            })->count();
            $laporansDiterimaCount = LaporanAkhir::where('status', 'diterima')->whereHas('user', function($q) use ($displayName) {
                $q->where('nama_opd', $displayName);
            })->count();
            
            $opdList->push((object)[
                'id' => $user->id,
                'nama_opd' => $displayName,
                'users_count' => User::where('nama_opd', $displayName)->count(),
                'laporans_count' => $laporansCount,
                'laporans_diterima_count' => $laporansDiterimaCount,
            ]);
        }

        // Pagination manual
        $perPage = 12;
        $page = request()->get('page', 1);
        $total = $opdList->count();
        $items = $opdList->slice(($page - 1) * $perPage, $perPage)->values();
        $opds = new \Illuminate\Pagination\LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => route('frontend.opd'),
        ]);

        // Get top 3 OPDs with most accepted reports
        $topOpds = $opdList->sortByDesc('laporans_diterima_count')->take(3)->values();

        // Total stats
        $totalLaporan = LaporanAkhir::count();
        $totalDiterima = LaporanAkhir::where('status', 'diterima')->count();

        return view('frondend.opd.index', compact('opds', 'topOpds', 'totalLaporan', 'totalDiterima'));
    }

    /**
     * OPD Detail - Detail OPD dengan statistik dan daftar laporan
     */
    public function opdDetail($id)
    {
        try {
            // Decode ID
            $decryptedId = decrypt($id);
            
            // Get user (OPD) by ID
            $opd = User::findOrFail($decryptedId);
            
            // Get all published laporan for this OPD
            $laporans = LaporanAkhir::with(['user'])
                ->where('user_id', $decryptedId)
                ->where('is_draft', false)
                ->where('is_published', true) // Only show published
                ->latest()
                ->get();
            
            // Statistik
            $totalLaporan = $laporans->count();
            $diterima = $laporans->where('status', 'diterima')->count();
            $ditolak = $laporans->where('status', 'ditolak')->count();
            $revisi = $laporans->where('status', 'revisi')->count();
            $menunggu = $laporans->where('status', 'menunggu verifikasi')->count();
            
            return view('frondend.opd.detail', compact('opd', 'laporans', 'totalLaporan', 'diterima', 'ditolak', 'revisi', 'menunggu'));
        } catch (\Exception $e) {
            return redirect()
                ->route('frontend.opd')
                ->with('error', 'OPD tidak ditemukan');
        }
    }

    /**
 * Dokumen Perencanaan Page - Daftar dokumen yang dipublikasikan
 */
public function dokumenPerencanaan(Request $request)
{
    $query = \App\Models\DokumenPerencanaan::with(['uploader'])
        ->where('status', 'published')
        ->where('is_online', true);

    // Filter by jenis
    if ($request->filled('jenis')) {
        $query->where('jenis', $request->jenis);
    }

    // Filter by tahun
    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    // Search
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        });
    }

    $dokumens = $query->latest('published_at')->paginate(12);
    
    // Get distinct years for filter
    $tahuns = \App\Models\DokumenPerencanaan::where('status', 'published')
        ->where('is_online', true)
        ->distinct()
        ->pluck('tahun')
        ->sortDesc();

    // Statistics
    $totalDokumen = \App\Models\DokumenPerencanaan::where('status', 'published')
        ->where('is_online', true)
        ->count();
    
    $dokumenTerbaru = \App\Models\DokumenPerencanaan::where('status', 'published')
        ->where('is_online', true)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('frondend.dokumen.index', compact('dokumens', 'tahuns', 'totalDokumen', 'dokumenTerbaru'));
}

/**
 * Dokumen Perencanaan Detail - Detail dan preview dokumen
 */
public function dokumenPerencanaanDetail($id)
{
    try {
        $dokumen = \App\Models\DokumenPerencanaan::with(['uploader'])
            ->where('status', 'published')
            ->where('is_online', true)
            ->findOrFail($id);

        // Dokumen terkait (same jenis, different id)
        $dokumenTerkait = \App\Models\DokumenPerencanaan::where('status', 'published')
            ->where('is_online', true)
            ->where('jenis', $dokumen->jenis)
            ->where('id', '!=', $dokumen->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frondend.dokumen.detail', compact('dokumen', 'dokumenTerkait'));
    } catch (\Exception $e) {
        return redirect()
            ->route('frontend.dokumen')
            ->with('error', 'Dokumen tidak ditemukan');
    }
}

/**
 * Download Dokumen Perencanaan (Public)
 */
public function dokumenPerencanaanDownload($id)
{
    try {
        $dokumen = \App\Models\DokumenPerencanaan::where('status', 'published')
            ->where('is_online', true)
            ->findOrFail($id);

        if (!\Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return \Storage::disk('public')->download(
            $dokumen->file_path,
            $dokumen->file_name
        );
    } catch (\Exception $e) {
        return redirect()
            ->route('frontend.dokumen')
            ->with('error', 'File tidak ditemukan');
    }
}

/**
 * Laporan Realisasi Anggaran Page - Daftar laporan (Public)
 */
public function laporanRealisasi(Request $request)
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

    $laporans = $query->latest()->paginate(12)->appends($request->all());

    // Statistik
    $totalAnggaran = LaporanRealisasiAnggaran::sum('anggaran');
    $totalRealisasi = LaporanRealisasiAnggaran::sum('realisasi');
    $totalPersen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 1) : 0;

    return view('frondend.laporan-realisasi.index', compact(
        'laporans', 'totalAnggaran', 'totalRealisasi', 'totalPersen'
    ));
}

/**
 * Laporan Realisasi Anggaran Detail - Detail laporan (Public)
 */
public function laporanRealisasiDetail($id)
{
    try {
        $laporan = LaporanRealisasiAnggaran::findOrFail($id);
        return view('frondend.laporan-realisasi.detail', compact('laporan'));
    } catch (\Exception $e) {
        return redirect()
            ->route('frontend.laporan-realisasi')
            ->with('error', 'Laporan tidak ditemukan');
    }
}
}
