<?php

namespace App\Http\Controllers\Frontend\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\ReportStoreRequest;
use App\Models\LaporanAkhir;
use App\Models\User;
use App\Notifications\LaporanAkhirUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Reports\ReportUpdateRequest; 

class ReportAppController extends Controller
{
    public function index()
    {
        $userAuth = Auth::user()->id;
        // Hanya laporan yang bukan draft dan belum diterima/ditolak
        $laporans = LaporanAkhir::with('user')
            ->where('user_id', $userAuth)
            ->where('is_draft', false)
            ->whereNotIn('status', ['diterima', 'ditolak'])
            ->latest()
            ->get();
        
        return view('apps.reports.index', compact('laporans'));
    }

    public function drafts()
    {
        $userAuth = Auth::user()->id;
        // Laporan draft atau yang sudah diterima/ditolak
        $drafts = LaporanAkhir::with('user')
            ->where('user_id', $userAuth)
            ->where(function($query) {
                $query->where('is_draft', true)
                      ->orWhereIn('status', ['diterima', 'ditolak']);
            })
            ->latest()
            ->get();
        
        return view('apps.reports.drafts', compact('drafts'));
    }

    public function create()
    {
        return view('apps.reports.create');
    }

    public function store(ReportStoreRequest $request)
    {
        $userId = Auth::user()->id;
        $validated = $request->validated();
        
        try {
            $validated['user_id'] = $userId;
            $validated['is_draft'] = $request->has('save_as_draft');
            $validated['status'] = $request->has('save_as_draft') ? 'draft' : 'menunggu verifikasi';

            // Upload files (simpan di disk public agar bisa diakses via asset())
            if ($request->hasFile('file_laporan')) {
                $validated['file_laporan'] = $request->file('file_laporan')->store('laporan', 'public');
            }

            if ($request->hasFile('file_sk')) {
                $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
            }

            if ($request->hasFile('file_pemaparan')) {
                $validated['file_pemaparan'] = $request->file('file_pemaparan')->store('pemaparan', 'public');
            }

            // File dokumentasi
            $fileDokumentasi = [];
            if ($request->hasFile('file_dokumentasi')) {
                foreach ($request->file('file_dokumentasi') as $file) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('dokumentasi', $filename, 'public');
                    $fileDokumentasi[] = $filename;
                }
            }
            $validated['file_dokumentasi'] = json_encode($fileDokumentasi);

            // File data pendukung
            $fileDataPendukung = [];
            if ($request->hasFile('file_data_pendukung')) {
                foreach ($request->file('file_data_pendukung') as $file) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('data_pendukung', $filename, 'public');
                    $fileDataPendukung[] = $filename;
                }
            }
            $validated['file_data_pendukung'] = json_encode($fileDataPendukung);

            $laporan = LaporanAkhir::create($validated);
            
            // Kirim notifikasi ke admin hanya jika bukan draft
            if (!$validated['is_draft']) {
                $admin = User::role('superadmin')->first();
                if ($admin) {
                    $admin->notify(new LaporanAkhirUploaded($laporan));
                }
            }

            $message = $validated['is_draft'] 
                ? 'Laporan berhasil disimpan sebagai draft' 
                : 'Laporan berhasil disubmit dan menunggu verifikasi';

            $route = $validated['is_draft'] 
                ? 'apps.reports.drafts' 
                : 'apps.reports.index';

            return redirect()
                ->route($route)
                ->with('success', $message);
                
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan laporan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptedId);
            
            // Cek apakah user berhak edit
            if (Auth::user()->id !== $laporan->user_id) {
                abort(403, 'Unauthorized action.');
            }

            // Hanya bisa edit jika status revisi atau draft
            if (!in_array($laporan->status, ['revisi', 'draft'])) {
                return redirect()
                    ->route('apps.reports.index')
                    ->with('error', 'Laporan tidak dapat diedit');
            }
            
            return view('apps.reports.edit', compact('laporan'));
            
        } catch (\Throwable $th) {
            return redirect()
                ->route('apps.reports.index')
                ->with('error', 'Laporan tidak ditemukan');
        }
    }

    // public function update(ReportStoreRequest $request, $id)
    // {
    //     try {
    //         $decryptedId = Crypt::decrypt($id);
    //         $laporan = LaporanAkhir::findOrFail($decryptedId);
            
    //         // Cek authorization
    //         if (Auth::user()->id !== $laporan->user_id) {
    //             abort(403, 'Unauthorized action.');
    //         }

    //         $validated = $request->validated();
    //         $validated['is_draft'] = $request->has('save_as_draft');
    //         $validated['status'] = $request->has('save_as_draft') ? 'draft' : 'menunggu verifikasi';

    //         // Update files jika ada (simpan di disk public)
    //         if ($request->hasFile('file_laporan')) {
    //             if ($laporan->file_laporan) {
    //                 Storage::disk('public')->delete($laporan->file_laporan);
    //             }
    //             $validated['file_laporan'] = $request->file('file_laporan')->store('laporan', 'public');
    //         }

    //         if ($request->hasFile('file_sk')) {
    //             if ($laporan->file_sk) {
    //                 Storage::disk('public')->delete($laporan->file_sk);
    //             }
    //             $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
    //         }

    //         if ($request->hasFile('file_pemaparan')) {
    //             if ($laporan->file_pemaparan) {
    //                 Storage::disk('public')->delete($laporan->file_pemaparan);
    //             }
    //             $validated['file_pemaparan'] = $request->file('file_pemaparan')->store('pemaparan', 'public');
    //         }

    //         // Update file dokumentasi
    //         if ($request->hasFile('file_dokumentasi')) {
    //             // Hapus file lama
    //             $oldFiles = json_decode($laporan->file_dokumentasi, true);
    //             if (is_array($oldFiles)) {
    //                 foreach ($oldFiles as $file) {
    //                     Storage::disk('public')->delete('dokumentasi/' . $file);
    //                 }
    //             }
                
    //             $fileDokumentasi = [];
    //             foreach ($request->file('file_dokumentasi') as $file) {
    //                 $filename = uniqid() . '_' . $file->getClientOriginalName();
    //                 $file->storeAs('dokumentasi', $filename, 'public');
    //                 $fileDokumentasi[] = $filename;
    //             }
    //             $validated['file_dokumentasi'] = json_encode($fileDokumentasi);
    //         }

    //         // Update file data pendukung
    //         if ($request->hasFile('file_data_pendukung')) {
    //             // Hapus file lama
    //             $oldFiles = json_decode($laporan->file_data_pendukung, true);
    //             if (is_array($oldFiles)) {
    //                 foreach ($oldFiles as $file) {
    //                     Storage::disk('public')->delete('data_pendukung/' . $file);
    //                 }
    //             }
                
    //             $fileDataPendukung = [];
    //             foreach ($request->file('file_data_pendukung') as $file) {
    //                 $filename = uniqid() . '_' . $file->getClientOriginalName();
    //                 $file->storeAs('data_pendukung', $filename, 'public');
    //                 $fileDataPendukung[] = $filename;
    //             }
    //             $validated['file_data_pendukung'] = json_encode($fileDataPendukung);
    //         }

    //         $laporan->update($validated);

    //         // Kirim notifikasi jika bukan draft
    //         if (!$validated['is_draft']) {
    //             $admin = User::role('superadmin')->first();
    //             if ($admin) {
    //                 $admin->notify(new LaporanAkhirUploaded($laporan));
    //             }
    //         }

    //         $message = $validated['is_draft'] 
    //             ? 'Laporan berhasil diupdate sebagai draft' 
    //             : 'Laporan berhasil diupdate dan menunggu verifikasi';

    //         $route = $validated['is_draft'] 
    //             ? 'apps.reports.drafts' 
    //             : 'apps.reports.index';

    //         return redirect()
    //             ->route($route)
    //             ->with('success', $message);
                
    //     } catch (\Throwable $th) {
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Gagal mengupdate laporan: ' . $th->getMessage());
    //     }
    // }
    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::findOrFail($decryptedId);
            
            // Cek authorization
            if (Auth::user()->id !== $laporan->user_id) {
                abort(403, 'Unauthorized action.');
            }
    
            // Log semua input untuk debug
            \Log::info('Form Submitted', [
                'all_input' => $request->all(),
                'has_files' => $request->hasFile('file_laporan'),
            ]);
    
            // Validasi manual tanpa Request class dulu
            $request->validate([
                'judul_kegiatan' => 'required|string|max:255',
                'jenis_kegiatan' => 'required|string',
                'penanggung_jawab' => 'required|string',
                'tahun_pelaksanaan' => 'required|integer',
                'lokasi_kegiatan' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'anggaran' => 'required|numeric',
                'latar_belakang' => 'required|string',
                'tujuan_kegiatan' => 'required|string',
                'metode_pelaksanaan' => 'required|string',
                'tahapan_pelaksanaan' => 'required|string',
                'output_kegiatan' => 'required|string',
                'hasil_kegiatan' => 'required|string',
                'persentase_realisasi' => 'required|integer',
                // File nullable
                'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
                'file_sk' => 'nullable|file|mimes:pdf|max:5120',
                'file_pemaparan' => 'nullable|file|mimes:ppt,pptx,pdf|max:20480',
            ]);
    
            // Update data (tanpa file dulu)
            $laporan->update([
                'judul_kegiatan' => $request->judul_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'tahun_pelaksanaan' => $request->tahun_pelaksanaan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'anggaran' => $request->anggaran,
                'latar_belakang' => $request->latar_belakang,
                'tujuan_kegiatan' => $request->tujuan_kegiatan,
                'metode_pelaksanaan' => $request->metode_pelaksanaan,
                'tahapan_pelaksanaan' => $request->tahapan_pelaksanaan,
                'output_kegiatan' => $request->output_kegiatan,
                'hasil_kegiatan' => $request->hasil_kegiatan,
                'persentase_realisasi' => $request->persentase_realisasi,
                'kendala_pelaksanaan' => $request->kendala_pelaksanaan,
                'solusi_kendala' => $request->solusi_kendala,
                'is_draft' => $request->has('save_as_draft'),
                'status' => $request->has('save_as_draft') ? 'draft' : 'menunggu verifikasi',
            ]);
    
            // Update files jika ada
            if ($request->hasFile('file_laporan')) {
                if ($laporan->file_laporan && Storage::disk('public')->exists($laporan->file_laporan)) {
                    Storage::disk('public')->delete($laporan->file_laporan);
                }
                $laporan->file_laporan = $request->file('file_laporan')->store('laporan', 'public');
                $laporan->save();
            }
    
            $message = $request->has('save_as_draft') 
                ? 'Laporan berhasil diupdate sebagai draft' 
                : 'Laporan berhasil diupdate dan menunggu verifikasi';
    
            $route = $request->has('save_as_draft') 
                ? 'apps.reports.drafts' 
                : 'apps.reports.index';
    
            return redirect()
                ->route($route)
                ->with('success', $message);
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', $e->errors());
            
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors())
                ->with('error', 'Validasi gagal: ' . json_encode($e->errors()));
                
        } catch (\Throwable $th) {
            \Log::error('Update Error:', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate: ' . $th->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::with('user')->findOrFail($decryptedId);
            
            // Cek apakah user berhak melihat (opsional, sesuaikan dengan kebutuhan)
            if (Auth::user()->id !== $laporan->user_id && !Auth::user()->hasRole('superadmin')) {
                abort(403, 'Unauthorized action.');
            }
            
            return view('apps.reports.show', compact('laporan'));
            
        } catch (\Throwable $th) {
            return redirect()
                ->route('apps.reports.index')
                ->with('error', 'Laporan tidak ditemukan');
        }
    }

    
}