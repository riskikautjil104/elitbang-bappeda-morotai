<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPerencanaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DokumenPerencanaanController extends Controller
{
    public function index(Request $request)
    {
        $query = DokumenPerencanaan::with(['uploader', 'opdTerpilih']);

        // Filter berdasarkan jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->forYear($request->tahun);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $dokumens = $query->latest()->paginate(15);
        $opds = User::whereHas('roles', function($query) {
            $query->where('name', 'opd'); // atau sesuai nama role kamu
        })->orderBy('name')->get();
        $years = range(date('Y'), date('Y') - 10);

        return view('admin.dokumen-perencanaan.index', compact('dokumens', 'opds', 'years'));
    }

    public function create()
    {
        $opds = User::whereHas('roles', function($query) {
            $query->where('name', 'opd');
        })->orderBy('name')->get();
        return view('admin.dokumen-perencanaan.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:RPJMD,RPJPD,RKPD,RENSTRA,RENJA,Lainnya',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 10),
            'is_online' => 'nullable|boolean',
            'visibility' => 'required|in:semua_opd,opd_terpilih,tidak_dikirim',
            'opd_ids' => 'required_if:visibility,opd_terpilih|array',
            'opd_ids.*' => 'exists:users,id'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('dokumen-perencanaan', $filename, 'public');

        $dokumen = DokumenPerencanaan::create([
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'tahun' => $request->tahun,
            'status' => 'draft',
            'is_online' => $request->boolean('is_online'),
            'visibility' => $request->visibility,
            'uploaded_by' => Auth::id()
        ]);

        // Attach OPD jika visibility = opd_terpilih
        if ($request->visibility === 'opd_terpilih' && $request->has('opd_ids')) {
            $dokumen->opdTerpilih()->attach($request->opd_ids);
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil ditambahkan'
        ]);
    }

    // public function show(DokumenPerencanaan $dokumenPerencanaan)
    // {
    //     $dokumenPerencanaan->load(['uploader', 'opdTerpilih']);
    //     return view('admin.dokumen-perencanaan.show', compact('dokumenPerencanaan'));
    // }
    public function show(DokumenPerencanaan $dokumenPerencanaan)
{
    $dokumenPerencanaan->load(['uploader', 'opdTerpilih']);
    
    // Check if request is AJAX/wants JSON
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'id' => $dokumenPerencanaan->id,
            'judul' => $dokumenPerencanaan->judul,
            'jenis' => $dokumenPerencanaan->jenis,
            'tahun' => $dokumenPerencanaan->tahun,
            'deskripsi' => $dokumenPerencanaan->deskripsi,
            'file_name' => $dokumenPerencanaan->file_name,
            'file_size' => $dokumenPerencanaan->file_size,
            'status' => $dokumenPerencanaan->status,
            'is_online' => $dokumenPerencanaan->is_online,
            'visibility' => $dokumenPerencanaan->visibility,
            'created_at' => $dokumenPerencanaan->created_at->toISOString(),
            'uploader' => $dokumenPerencanaan->uploader ? [
                'name' => $dokumenPerencanaan->uploader->name
            ] : null,
            'opd_terpilih' => $dokumenPerencanaan->opdTerpilih->map(function($opd) {
                return ['id' => $opd->id, 'name' => $opd->name];
            })
        ]);
    }
    
    return view('admin.dokumen-perencanaan.show', compact('dokumenPerencanaan'));
}

//     public function edit(DokumenPerencanaan $dokumenPerencanaan)
// {
//         $opds = User::whereHas('roles', function($query) {
//             $query->where('name', 'opd');
//         })->orderBy('name')->get();
//         $selectedOpds = $dokumenPerencanaan->opdTerpilih->pluck('id')->toArray();
        
//         return view('admin.dokumen-perencanaan.edit', compact('dokumenPerencanaan', 'opds', 'selectedOpds'));
//     }
public function edit(DokumenPerencanaan $dokumenPerencanaan)
{
    $opds = User::whereHas('roles', function($query) {
        $query->where('name', 'opd');
    })->orderBy('name')->get();
    
    $selectedOpds = $dokumenPerencanaan->opdTerpilih->pluck('id')->toArray();
    
    // Check if request is AJAX/wants JSON
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'dokumen' => $dokumenPerencanaan,
            'opds' => $opds,
            'selectedOpds' => $selectedOpds
        ]);
    }
    
    // Regular request returns view
    return view('admin.dokumen-perencanaan.edit', compact('dokumenPerencanaan', 'opds', 'selectedOpds'));
}

public function update(Request $request, DokumenPerencanaan $dokumenPerencanaan)
{
    try {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:RPJMD,RPJPD,RKPD,RENSTRA,RENJA,Lainnya',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 10),
            'is_online' => 'nullable|boolean',
            'visibility' => 'required|in:semua_opd,opd_terpilih,tidak_dikirim',
            'opd_ids' => 'required_if:visibility,opd_terpilih|array',
            'opd_ids.*' => 'exists:users,id'
        ]);

        $data = [
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'tahun' => $request->tahun,
            'is_online' => $request->has('is_online') ? 1 : 0,
            'visibility' => $request->visibility
        ];

        // Handle file upload jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($dokumenPerencanaan->file_path)) {
                Storage::disk('public')->delete($dokumenPerencanaan->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('dokumen-perencanaan', $filename, 'public');

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $dokumenPerencanaan->update($data);

        // Sync OPD
        if ($request->visibility === 'opd_terpilih' && $request->has('opd_ids')) {
            $dokumenPerencanaan->opdTerpilih()->sync($request->opd_ids);
        } else {
            $dokumenPerencanaan->opdTerpilih()->detach();
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil diperbarui'
        ]);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        \Log::error('Error updating dokumen: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    public function destroy(DokumenPerencanaan $dokumenPerencanaan)
    {
        // Hapus file
        if (Storage::disk('public')->exists($dokumenPerencanaan->file_path)) {
            Storage::disk('public')->delete($dokumenPerencanaan->file_path);
        }

        $dokumenPerencanaan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }

    public function togglePublish(DokumenPerencanaan $dokumenPerencanaan)
    {
        $newStatus = $dokumenPerencanaan->status === 'draft' ? 'published' : 'draft';
        
        $dokumenPerencanaan->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'published' ? now() : null
        ]);

        return response()->json([
            'success' => true,
            'message' => $newStatus === 'published' 
                ? 'Dokumen berhasil dipublish' 
                : 'Dokumen dikembalikan ke draft',
            'status' => $newStatus
        ]);
    }

    public function download(DokumenPerencanaan $dokumenPerencanaan)
    {
        if (!Storage::disk('public')->exists($dokumenPerencanaan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download(
            $dokumenPerencanaan->file_path,
            $dokumenPerencanaan->file_name
        );
    }
}