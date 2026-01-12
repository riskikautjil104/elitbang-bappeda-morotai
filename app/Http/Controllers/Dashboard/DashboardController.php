<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('superadmin')) {
            return $this->superadminDashboard();
        }

        if ($user->hasRole('opd')) {
            return $this->opdDashboard();
        }

        return view('dashboard.index');
    }

    /**
     * 🎯 Enhanced Dashboard untuk Superadmin
     */
    protected function superadminDashboard()
    {
        // === STATISTIK UTAMA ===
        $totalLaporan = LaporanAkhir::count();
        $laporanDiajukan = LaporanAkhir::where('status', 'menunggu verifikasi')->count();
        $laporanDisetujui = LaporanAkhir::where('status', 'diterima')->count();
        $laporanDirevisi = LaporanAkhir::where('status', 'revisi')->count();
        $laporanDitolak = LaporanAkhir::where('status', 'ditolak')->count();
        $totalUsers = User::role('opd')->count();

        // === LAPORAN PER TAHUN ===
        $laporanPerTahun = LaporanAkhir::select(
                DB::raw('tahun_pelaksanaan as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tahun_pelaksanaan')
            ->orderBy('tahun_pelaksanaan')
            ->get();

        // === GROWTH PERCENTAGE ===
        $tahunIni = date('Y');
        $tahunLalu = $tahunIni - 1;
        $laporanTahunIni = LaporanAkhir::where('tahun_pelaksanaan', $tahunIni)->count();
        $laporanTahunLalu = LaporanAkhir::where('tahun_pelaksanaan', $tahunLalu)->count();
        
        if ($laporanTahunLalu > 0) {
            $growthPercentage = round((($laporanTahunIni - $laporanTahunLalu) / $laporanTahunLalu) * 100, 1);
        } else {
            $growthPercentage = $laporanTahunIni > 0 ? 100 : 0;
        }

        // === TOP 5 OPD ===
        $topOpd = LaporanAkhir::select('user_id', DB::raw('COUNT(*) as total'))
            ->with('user:id,nama_opd')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nama_opd' => $item->user->nama_opd ?? 'N/A',
                    'total' => $item->total
                ];
            });

        // === ANGGARAN ===
        $totalAnggaran = LaporanAkhir::sum('anggaran');
        $totalAnggaranFormatted = 'Rp ' . number_format($totalAnggaran / 1000000000, 2) . ' M';
        
        $totalRealisasi = LaporanAkhir::sum(DB::raw('(anggaran * persentase_realisasi) / 100'));
        $totalRealisasiFormatted = 'Rp ' . number_format($totalRealisasi / 1000000000, 2) . ' M';
        
        $rataRealisasi = LaporanAkhir::avg('persentase_realisasi') ?? 0;

        // === JENIS KEGIATAN ===
        $totalJenisKegiatan = LaporanAkhir::distinct('jenis_kegiatan')->count('jenis_kegiatan');
        
        $distribusiJenisKegiatan = LaporanAkhir::select('jenis_kegiatan', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_kegiatan')
            ->orderByDesc('total')
            ->get();

        // === 📊 MONITORING PERFORMA OPD ===
        $performaOpd = User::role('opd')
            ->withCount([
                'laporans as total_laporan',
                'laporans as laporan_disetujui' => function($q) {
                    $q->where('status', 'diterima');
                },
                'laporans as laporan_pending' => function($q) {
                    $q->where('status', 'menunggu verifikasi');
                }
            ])
            ->with(['laporans' => function($q) {
                $q->select('user_id', 
                    DB::raw('AVG(persentase_realisasi) as avg_realisasi'),
                    DB::raw('SUM(anggaran) as total_anggaran')
                )
                ->groupBy('user_id');
            }])
            ->having('total_laporan', '>', 0)
            ->get()
            ->map(function($opd) {
                $laporanData = $opd->laporans->first();
                $avgRealisasi = $laporanData ? $laporanData->avg_realisasi : 0;
                $totalAnggaran = $laporanData ? $laporanData->total_anggaran : 0;
                
                return (object) [
                    'nama_opd' => $opd->nama_opd,
                    'total_laporan' => $opd->total_laporan,
                    'disetujui' => $opd->laporan_disetujui,
                    'pending' => $opd->laporan_pending,
                    'avg_realisasi' => round($avgRealisasi, 1),
                    'total_anggaran' => $totalAnggaran,
                    'performance_score' => $this->calculatePerformanceScore($opd->total_laporan, $opd->laporan_disetujui, $avgRealisasi)
                ];
            })
            ->sortByDesc('performance_score')
            ->take(10);

        // === 📅 TREND BULANAN (12 BULAN TERAKHIR) ===
        $trendBulanan = LaporanAkhir::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "disetujui" THEN 1 ELSE 0 END) as disetujui'),
                DB::raw('SUM(CASE WHEN status = "diajukan" THEN 1 ELSE 0 END) as pending')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->map(function($item) {
                return [
                    'bulan' => Carbon::parse($item->bulan)->format('M Y'),
                    'total' => $item->total,
                    'disetujui' => $item->disetujui,
                    'pending' => $item->pending
                ];
            });

        // === 🎯 ANALISIS WAKTU VERIFIKASI ===
        $avgWaktuVerifikasi = LaporanAkhir::whereNotNull('tanggal_verifikasi')
            ->select(DB::raw('AVG(DATEDIFF(tanggal_verifikasi, created_at)) as avg_days'))
            ->first()
            ->avg_days ?? 0;

        $distribusiWaktuVerifikasi = LaporanAkhir::whereNotNull('tanggal_verifikasi')
            ->select(DB::raw('
                CASE 
                    WHEN DATEDIFF(tanggal_verifikasi, created_at) <= 3 THEN "1-3 hari"
                    WHEN DATEDIFF(tanggal_verifikasi, created_at) <= 7 THEN "4-7 hari"
                    WHEN DATEDIFF(tanggal_verifikasi, created_at) <= 14 THEN "8-14 hari"
                    ELSE "> 14 hari"
                END as kategori
            '), DB::raw('COUNT(*) as total'))
            ->groupBy('kategori')
            ->get();

        // === 📈 TREND STATUS LAPORAN ===
        $trendStatus = LaporanAkhir::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        // === 🏆 STATISTIK REALISASI ===
        $realisasiTertinggi = LaporanAkhir::orderByDesc('persentase_realisasi')
            ->with('user:id,nama_opd')
            ->limit(5)
            ->get();

        $realisasiTerendah = LaporanAkhir::where('persentase_realisasi', '>', 0)
            ->orderBy('persentase_realisasi')
            ->with('user:id,nama_opd')
            ->limit(5)
            ->get();

        // === LAPORAN TERBARU ===
        $laporanTerbaru = LaporanAkhir::with('user:id,nama_opd')
            ->latest()
            ->limit(10)
            ->get();

        $laporanPending = LaporanAkhir::with('user:id,nama_opd')
            ->where('status', 'menunggu verifikasi')
            ->latest()
            ->limit(10)
            ->get();

        $laporanApproved = LaporanAkhir::with('user:id,nama_opd')
            ->where('status', 'diterima')
            ->latest()
            ->limit(10)
            ->get();

        // === 🔔 NOTIFIKASI & ALERT ===
        $laporanUrgent = LaporanAkhir::where('status', 'menunggu verifikasi')
            ->where('created_at', '<=', Carbon::now()->subDays(7))
            ->count();

        $opdInactive = User::role('opd')
            ->whereDoesntHave('laporans', function($q) {
                $q->where('created_at', '>=', Carbon::now()->subMonths(3));
            })
            ->count();

        return view('dashboard.superadmin', compact(
            'totalLaporan', 'laporanDiajukan', 'laporanDisetujui', 'laporanDirevisi', 'laporanDitolak',
            'laporanPerTahun', 'growthPercentage', 'topOpd', 'totalUsers',
            'totalAnggaran', 'totalAnggaranFormatted', 'totalRealisasi', 'totalRealisasiFormatted',
            'rataRealisasi', 'totalJenisKegiatan', 'distribusiJenisKegiatan',
            'performaOpd', 'trendBulanan', 'avgWaktuVerifikasi', 'distribusiWaktuVerifikasi',
            'trendStatus', 'realisasiTertinggi', 'realisasiTerendah',
            'laporanTerbaru', 'laporanPending', 'laporanApproved',
            'laporanUrgent', 'opdInactive'
        ));
    }

    /**
     * 🎯 Enhanced Dashboard untuk OPD
     */
    protected function opdDashboard()
    {
        $userId = Auth::id();

        // === STATISTIK UTAMA ===
        $totalLaporan = LaporanAkhir::where('user_id', $userId)->count();
        $laporanDiajukan = LaporanAkhir::where('user_id', $userId)->where('status', 'menunggu verifikasi')->count();
        $laporanDisetujui = LaporanAkhir::where('user_id', $userId)->where('status', 'diterima')->count();
        $laporanDirevisi = LaporanAkhir::where('user_id', $userId)->where('status', 'revisi')->count();
        $laporanDitolak = LaporanAkhir::where('user_id', $userId)->where('status', 'ditolak')->count();

        // === LAPORAN PER TAHUN ===
        $laporanPerTahun = LaporanAkhir::select(
                DB::raw('tahun_pelaksanaan as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('user_id', $userId)
            ->groupBy('tahun_pelaksanaan')
            ->orderBy('tahun_pelaksanaan')
            ->get();

        // === GROWTH PERCENTAGE ===
        $tahunIni = date('Y');
        $tahunLalu = $tahunIni - 1;
        $laporanTahunIni = LaporanAkhir::where('user_id', $userId)
            ->where('tahun_pelaksanaan', $tahunIni)->count();
        $laporanTahunLalu = LaporanAkhir::where('user_id', $userId)
            ->where('tahun_pelaksanaan', $tahunLalu)->count();
        
        if ($laporanTahunLalu > 0) {
            $growthPercentage = round((($laporanTahunIni - $laporanTahunLalu) / $laporanTahunLalu) * 100, 1);
        } else {
            $growthPercentage = $laporanTahunIni > 0 ? 100 : 0;
        }

        // === TOP JENIS KEGIATAN ===
        $topJenisKegiatan = LaporanAkhir::select('jenis_kegiatan', DB::raw('COUNT(*) as total'))
            ->where('user_id', $userId)
            ->groupBy('jenis_kegiatan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // === ANGGARAN ===
        $totalAnggaran = LaporanAkhir::where('user_id', $userId)->sum('anggaran');
        $totalAnggaranFormatted = 'Rp ' . number_format($totalAnggaran / 1000000000, 2) . ' M';

        $totalRealisasi = LaporanAkhir::where('user_id', $userId)
            ->sum(DB::raw('(anggaran * persentase_realisasi) / 100'));
        $totalRealisasiFormatted = 'Rp ' . number_format($totalRealisasi / 1000000000, 2) . ' M';

        $rataRealisasi = LaporanAkhir::where('user_id', $userId)
            ->avg('persentase_realisasi') ?? 0;

        $totalJenisKegiatan = LaporanAkhir::where('user_id', $userId)
            ->distinct('jenis_kegiatan')
            ->count('jenis_kegiatan');

        // === 📅 LAPORAN PER BULAN (12 BULAN) ===
        $laporanPerBulan = LaporanAkhir::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "diterima" THEN 1 ELSE 0 END) as disetujui')
            )
            ->where('user_id', $userId)
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->map(function ($item) {
                $bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                return [
                    'bulan' => $bulanNama[$item->bulan - 1],
                    'total' => $item->total,
                    'disetujui' => $item->disetujui
                ];
            });

        // === 🎯 ANALISIS PERFORMA ===
        $tingkatKeberhasilan = $totalLaporan > 0 
            ? round(($laporanDisetujui / $totalLaporan) * 100, 1) 
            : 0;

        $tingkatRevisi = $totalLaporan > 0 
            ? round((($laporanDirevisi + $laporanDitolak) / $totalLaporan) * 100, 1) 
            : 0;

        // === ⏱️ RATA-RATA WAKTU VERIFIKASI ===
        $avgWaktuVerifikasi = LaporanAkhir::where('user_id', $userId)
            ->whereNotNull('tanggal_verifikasi')
            ->select(DB::raw('AVG(DATEDIFF(tanggal_verifikasi, created_at)) as avg_days'))
            ->first()
            ->avg_days ?? 0;

        // === 📊 DISTRIBUSI REALISASI ===
        $distribusiRealisasi = LaporanAkhir::where('user_id', $userId)
            ->select(DB::raw('
                CASE 
                    WHEN persentase_realisasi >= 90 THEN "Excellent (≥90%)"
                    WHEN persentase_realisasi >= 75 THEN "Good (75-89%)"
                    WHEN persentase_realisasi >= 50 THEN "Average (50-74%)"
                    ELSE "Low (<50%)"
                END as kategori
            '), DB::raw('COUNT(*) as total'))
            ->groupBy('kategori')
            ->get();

        // === 🏆 RANKING POSISI ===
        $rankingPosisi = $this->getRankingOPD($userId);

        // === LAPORAN LISTS ===
        $laporanTerbaru = LaporanAkhir::where('user_id', $userId)
            ->latest()
            ->limit(10)
            ->get();

        $laporanPending = LaporanAkhir::where('user_id', $userId)
            ->where('status', 'menunggu verifikasi')
            ->latest()
            ->limit(10)
            ->get();

        $laporanApproved = LaporanAkhir::where('user_id', $userId)
            ->where('status', 'diterima')
            ->latest()
            ->limit(10)
            ->get();

        // === 🔔 NOTIFIKASI ===
        $laporanPerluRevisi = LaporanAkhir::where('user_id', $userId)
            ->where('status', 'revisi')
            ->count();

        $laporanMenungguLama = LaporanAkhir::where('user_id', $userId)
            ->where('status', 'menunggu verifikasi')
            ->where('created_at', '<=', Carbon::now()->subDays(7))
            ->count();

        return view('dashboard.opd', compact(
            'totalLaporan', 'laporanDiajukan', 'laporanDisetujui', 'laporanDirevisi', 'laporanDitolak',
            'laporanPerTahun', 'growthPercentage', 'topJenisKegiatan',
            'totalAnggaran', 'totalAnggaranFormatted', 'totalRealisasi', 'totalRealisasiFormatted',
            'rataRealisasi', 'totalJenisKegiatan', 'laporanPerBulan',
            'tingkatKeberhasilan', 'tingkatRevisi', 'avgWaktuVerifikasi',
            'distribusiRealisasi', 'rankingPosisi',
            'laporanTerbaru', 'laporanPending', 'laporanApproved',
            'laporanPerluRevisi', 'laporanMenungguLama'
        ));
    }

    /**
     * Calculate Performance Score
     */
    private function calculatePerformanceScore($totalLaporan, $disetujui, $avgRealisasi)
    {
        if ($totalLaporan == 0) return 0;

        $approvalRate = ($disetujui / $totalLaporan) * 100;
        $score = ($approvalRate * 0.6) + ($avgRealisasi * 0.4);

        return round($score, 1);
    }

    /**
     * Get Ranking OPD
     */
    private function getRankingOPD($userId)
    {
        $rankings = User::role('opd')
            ->withCount([
                'laporans as total_laporan',
                'laporans as laporan_disetujui' => function($q) {
                    $q->where('status', 'diterima');
                }
            ])
            ->with(['laporans' => function($q) {
                $q->select('user_id', DB::raw('AVG(persentase_realisasi) as avg_realisasi'))
                  ->groupBy('user_id');
            }])
            ->having('total_laporan', '>', 0)
            ->get()
            ->map(function($opd) {
                $laporanData = $opd->laporans->first();
                $avgRealisasi = $laporanData ? $laporanData->avg_realisasi : 0;
                
                return [
                    'id' => $opd->id,
                    'score' => $this->calculatePerformanceScore(
                        $opd->total_laporan,
                        $opd->laporan_disetujui,
                        $avgRealisasi
                    )
                ];
            })
            ->sortByDesc('score')
            ->values();

        $position = $rankings->search(function($item) use ($userId) {
            return $item['id'] == $userId;
        });

        return [
            'position' => $position !== false ? $position + 1 : null,
            'total' => $rankings->count(),
            'score' => $rankings->firstWhere('id', $userId)['score'] ?? 0
        ];
    }

    // Password change methods
    public function showChangePasswordForm()
    {
        return view('dashboard.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    public function showChangePasswordFormOpd()
    {
        return view('dashboard.change-password-opd');
    }

    public function changePasswordOpd(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}