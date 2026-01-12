<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRealisasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
            'realisasi' => 'required|numeric|min:0',
            'tanggal_kegiatan' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'file_pendukung' => 'nullable|array',
            'file_pendukung.*' => 'file|max:51200|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,mp4,mov,avi',
            'keterangan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.max' => 'Nama kegiatan maksimal 255 karakter.',
            'anggaran.required' => 'Anggaran wajib diisi.',
            'anggaran.numeric' => 'Anggaran harus berupa angka.',
            'anggaran.min' => 'Anggaran tidak boleh negatif.',
            'realisasi.required' => 'Realisasi wajib diisi.',
            'realisasi.numeric' => 'Realisasi harus berupa angka.',
            'realisasi.min' => 'Realisasi tidak boleh negatif.',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid.',
            'file_pendukung.array' => 'File pendukung harus berupa array.',
            'file_pendukung.*.max' => 'File maksimal 50MB.',
            'file_pendukung.*.mimes' => 'Format file tidak didukung. Format yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, JPEG, PNG, GIF, MP4, MOV, AVI.',
        ];
    }
}

