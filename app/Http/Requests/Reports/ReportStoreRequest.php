<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'user_id' => 'required',
            'penanggung_jawab' => 'required',
            'tahun_pelaksanaan' => 'required',
            'lokasi_kegiatan' => 'required',
            'tanggal_mulai' => 'required|different:tanggal_selesai',
            'tanggal_selesai' => 'required|different:tanggal_mulai',
            'anggaran' => 'required',
            'latar_belakang' => 'required',
            'tujuan_kegiatan' => 'required',
            'metode_pelaksanaan' => 'required',
            'tahapan_pelaksanaan' => 'required',
            'output_kegiatan' => 'required',
            'hasil_kegiatan' => 'required',
            'persentase_realisasi' => 'required|numeric',
            'kendala_pelaksanaan' => 'required',
            'solusi_kendala' => 'required',
            'file_laporan' => 'required',
            'file_dokumentasi' => 'required',
            'file_data_pendukung' => 'required',
            'file_sk' => 'required',
            'file_pemaparan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'judul_kegiatan.required' => 'Judul Kegiatan wajib diisi',
            'jenis_kegiatan.required' => 'Jenis Kegiatan wajib diisi',
            'user_id.required' => 'OPD Pengusul wajib diisi',
            'penanggung_jawab.required' => 'Penanggung Jawab wajib diisi',
            'tahun_pelaksanaan.required' => 'Tahun Pelaksanaan wajib diisi',
            'lokasi_kegiatan.required' => 'Lokasi Kegiatan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal Mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal Selesai wajib diisi',
            'tanggal_mulai.different' => 'Tanggal Mulai dan Tanggal Selesai tidak boleh sama',
            'tanggal_selesai.different' => 'Tanggal Mulai dan Tanggal Selesai tidak boleh sama',
            'anggaran.required' => 'Anggaran wajib diisi',
            'latar_belakang.required' => 'Latar Belakang wajib diisi',
            'tujuan_kegiatan.required' => 'Tujuan Kegiatan wajib diisi',
            'metode_pelaksanaan.required' => 'Metode Pelaksanaan wajib diisi',
            'tahapan_pelaksanaan.required' => 'Tahapan Pelaksanaan wajib diisi',
            'output_kegiatan.required' => 'Output Kegiatan wajib diisi',
            'hasil_kegiatan.required' => 'Hasil Kegiatan wajib diisi',
            'persentase_realisasi.required' => 'Persentase Realisasi wajib diisi',
            'kendala_pelaksanaan.required' => 'Kendala Pelaksanaan wajib diisi',
            'solusi_kendala.required' => 'Solusi Kendala wajib diisi',
            'file_laporan.required' => 'File Laporan wajib diisi',
            'file_dokumentasi.required' => 'File Dokumentasi wajib diisi',
            'file_data_pendukung.required' => 'File Data Pendukung wajib diisi',
            'file_sk.required' => 'File SK wajib diisi',
            'file_pemaparan.required' => 'File Pemaparan wajib diisi',
        ];
    }
}
