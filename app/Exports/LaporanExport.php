<?php

namespace App\Exports;

use App\Models\LaporanAkhir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = LaporanAkhir::with(['user', 'verifiedBy']);

        // Apply filters if request exists
        if ($this->request) {
            if ($this->request->has('search') && $this->request->search) {
                $search = $this->request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                      ->orWhere('jenis_kegiatan', 'like', "%{$search}%");
                });
            }

            if ($this->request->has('status') && $this->request->status) {
                $query->where('status', $this->request->status);
            }

            if ($this->request->has('tahun') && $this->request->tahun) {
                $query->where('tahun_pelaksanaan', $this->request->tahun);
            }
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Kegiatan',
            'Jenis Kegiatan',
            'OPD',
            'Penanggung Jawab',
            'Tahun Pelaksanaan',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Anggaran',
            'Realisasi (%)',
            'Status',
            'Tanggal Submit',
            'Verifikasi Oleh',
            'Tanggal Verifikasi',
            'Catatan Admin'
        ];
    }

    public function map($laporan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $laporan->judul_kegiatan,
            $laporan->jenis_kegiatan,
            $laporan->user->name ?? '-',
            $laporan->penanggung_jawab,
            $laporan->tahun_pelaksanaan,
            $laporan->tanggal_mulai ? date('d/m/Y', strtotime($laporan->tanggal_mulai)) : '-',
            $laporan->tanggal_selesai ? date('d/m/Y', strtotime($laporan->tanggal_selesai)) : '-',
            'Rp ' . number_format($laporan->anggaran ?? 0, 0, ',', '.'),
            $laporan->persentase_realisasi . '%',
            ucfirst($laporan->status),
            $laporan->created_at->format('d/m/Y H:i'),
            $laporan->verifiedBy->name ?? '-',
            $laporan->tanggal_verifikasi ? date('d/m/Y', strtotime($laporan->tanggal_verifikasi)) : '-',
            $laporan->catatan_admin ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true]
            ],
        ];
    }
}