<?php

namespace App\Http\Controllers\Opd;

use App\Http\Controllers\Controller;
use App\Models\DokumenPerencanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenPerencanaanController extends Controller
{
    public function index(Request $request)
    {
        $opdId = Auth::id();
        
        $query = DokumenPerencanaan::published()
            // Eager load relasi opdTerpilih hanya untuk user yang login
            ->with(['opdTerpilih' => function($q) use ($opdId) {
                $q->where('dokumen_opd.opd_id', $opdId);
            }])
            ->where(function($q) use ($opdId) {
                $q->where('dokumen_perencanaan.visibility', 'semua_opd')
                  ->orWhere(function($q2) use ($opdId) {
                      $q2->where('dokumen_perencanaan.visibility', 'opd_terpilih')
                         ->whereHas('opdTerpilih', function($q3) use ($opdId) {
                             $q3->where('dokumen_opd.opd_id', $opdId);
                         });
                  });
            });
    
        if ($request->filled('jenis')) {
            $query->where('dokumen_perencanaan.jenis', $request->jenis);
        }
    
        if ($request->filled('tahun')) {
            $query->forYear($request->tahun);
        }
    
        $dokumens = $query->latest('dokumen_perencanaan.published_at')->paginate(15);
        $years = range(date('Y'), date('Y') - 10);
    
        return view('opd.dokumen-perencanaan.index', compact('dokumens', 'years'));
    }

public function show(DokumenPerencanaan $dokumenPerencanaan)
{
    $opdId = Auth::id();

    if (!$dokumenPerencanaan->canBeViewedByOpd($opdId)) {
        abort(403, 'Anda tidak memiliki akses ke dokumen ini');
    }

    // Load relasi OPD terpilih untuk user yang login
    $dokumenPerencanaan->load(['opdTerpilih' => function($q) use ($opdId) {
        $q->where('dokumen_opd.opd_id', $opdId);
    }]);

    // Mark as read
    if ($dokumenPerencanaan->visibility === 'opd_terpilih') {
        $dokumenPerencanaan->opdTerpilih()->updateExistingPivot($opdId, [
            'is_read' => true,
            'read_at' => now()
        ]);
        
        // Reload relasi setelah update
        $dokumenPerencanaan->load(['opdTerpilih' => function($q) use ($opdId) {
            $q->where('dokumen_opd.opd_id', $opdId);
        }]);
    }

    return view('opd.dokumen-perencanaan.show', compact('dokumenPerencanaan'));
}

    public function download(DokumenPerencanaan $dokumenPerencanaan)
    {
        $opdId = Auth::id();

        if (!$dokumenPerencanaan->canBeViewedByOpd($opdId)) {
            abort(403, 'Anda tidak memiliki akses ke dokumen ini');
        }

        if (!Storage::disk('public')->exists($dokumenPerencanaan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download(
            $dokumenPerencanaan->file_path,
            $dokumenPerencanaan->file_name
        );
    }
}