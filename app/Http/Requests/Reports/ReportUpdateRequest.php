<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class ReportUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Informasi Umum - Required
            'judul_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|in:penelitian,pengembangan',
            'penanggung_jawab' => 'required|string|max:255',
            'tahun_pelaksanaan' => 'required|integer|min:2000|max:2100',
            'lokasi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'anggaran' => 'required|numeric|min:0',

            // Detail Kegiatan - Required
            'latar_belakang' => 'required|string|min:100',
            'tujuan_kegiatan' => 'required|string',
            'metode_pelaksanaan' => 'required|string',
            'tahapan_pelaksanaan' => 'required|string',

            // Hasil dan Evaluasi - Required
            'output_kegiatan' => 'required|string',
            'hasil_kegiatan' => 'required|string',
            'persentase_realisasi' => 'required|integer|min:0|max:100',
            'kendala_pelaksanaan' => 'nullable|string',
            'solusi_kendala' => 'nullable|string',

            // Files - NULLABLE untuk update
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_dokumentasi' => 'nullable|array',
            'file_dokumentasi.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,zip,rar|max:51200',
            'file_data_pendukung' => 'nullable|array',
            'file_data_pendukung.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:20480',
            'file_sk' => 'nullable|file|mimes:pdf|max:5120',
            'file_pemaparan' => 'nullable|file|mimes:ppt,pptx,pdf|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'judul_kegiatan.required' => 'Judul kegiatan wajib diisi',
            'jenis_kegiatan.required' => 'Jenis kegiatan wajib dipilih',
            'jenis_kegiatan.in' => 'Jenis kegiatan tidak valid',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi',
            'tahun_pelaksanaan.required' => 'Tahun pelaksanaan wajib diisi',
            'tahun_pelaksanaan.integer' => 'Tahun pelaksanaan harus berupa angka',
            'tahun_pelaksanaan.min' => 'Tahun pelaksanaan minimal 2000',
            'tahun_pelaksanaan.max' => 'Tahun pelaksanaan maksimal 2100',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_mulai.date' => 'Format tanggal mulai tidak valid',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.date' => 'Format tanggal selesai tidak valid',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'anggaran.required' => 'Anggaran wajib diisi',
            'anggaran.numeric' => 'Anggaran harus berupa angka',
            'anggaran.min' => 'Anggaran minimal 0',
            'latar_belakang.required' => 'Latar belakang wajib diisi',
            'latar_belakang.min' => 'Latar belakang minimal 100 karakter',
            'tujuan_kegiatan.required' => 'Tujuan kegiatan wajib diisi',
            'metode_pelaksanaan.required' => 'Metode pelaksanaan wajib diisi',
            'tahapan_pelaksanaan.required' => 'Tahapan pelaksanaan wajib diisi',
            'output_kegiatan.required' => 'Output kegiatan wajib diisi',
            'hasil_kegiatan.required' => 'Hasil kegiatan wajib diisi',
            'persentase_realisasi.required' => 'Persentase realisasi wajib diisi',
            'persentase_realisasi.integer' => 'Persentase realisasi harus berupa angka',
            'persentase_realisasi.min' => 'Persentase realisasi minimal 0',
            'persentase_realisasi.max' => 'Persentase realisasi maksimal 100',
            
            // File validation messages
            'file_laporan.mimes' => 'File laporan harus berformat PDF',
            'file_laporan.max' => 'File laporan maksimal 10MB',
            'file_dokumentasi.*.mimes' => 'File dokumentasi harus berformat JPG, PNG, MP4, ZIP, atau RAR',
            'file_dokumentasi.*.max' => 'File dokumentasi maksimal 50MB per file',
            'file_data_pendukung.*.mimes' => 'File data pendukung harus berformat PDF, Word, Excel, ZIP, atau RAR',
            'file_data_pendukung.*.max' => 'File data pendukung maksimal 20MB per file',
            'file_sk.mimes' => 'File SK harus berformat PDF',
            'file_sk.max' => 'File SK maksimal 5MB',
            'file_pemaparan.mimes' => 'File pemaparan harus berformat PPT, PPTX, atau PDF',
            'file_pemaparan.max' => 'File pemaparan maksimal 20MB',
        ];
    }
}