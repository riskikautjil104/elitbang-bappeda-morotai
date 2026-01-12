<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use Illuminate\Support\Facades\Storage;

class LaporanExportController extends Controller
{
    /**
     * Export Laporan ke PDF
     */
    public function exportPDF($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::with(['user', 'verifiedBy'])->findOrFail($decryptedId);
            
            // Cek authorization
            $this->checkExportAuthorization($laporan);
            
            // Generate PDF
            $pdf = PDF::loadView('exports.laporan-pdf', compact('laporan'))
                ->setPaper('a4', 'portrait')
                ->setOption('margin-top', 10)
                ->setOption('margin-right', 10)
                ->setOption('margin-bottom', 10)
                ->setOption('margin-left', 10);
            
            $filename = 'Laporan_' . str_replace(' ', '_', $laporan->judul_kegiatan) . '_' . date('YmdHis') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal export PDF: ' . $th->getMessage());
        }
    }
    
    /**
     * Export Laporan ke Word (.docx)
     */
    public function exportWord($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $laporan = LaporanAkhir::with(['user', 'verifiedBy'])->findOrFail($decryptedId);
            
            // Cek authorization
            $this->checkExportAuthorization($laporan);
            
            // Create new PHPWord object
            $phpWord = new PhpWord();
            
            // Set document properties
            $properties = $phpWord->getDocInfo();
            $properties->setCreator('E-Litbang System');
            $properties->setCompany('Pemerintah Kota');
            $properties->setTitle('Laporan Akhir Kegiatan');
            $properties->setDescription('Laporan Akhir Kegiatan ' . $laporan->judul_kegiatan);
            $properties->setSubject('Laporan Kegiatan');
            
            // Add section
            $section = $phpWord->addSection([
                'marginTop' => Converter::cmToTwip(2),
                'marginBottom' => Converter::cmToTwip(2),
                'marginLeft' => Converter::cmToTwip(3),
                'marginRight' => Converter::cmToTwip(2),
            ]);
            
            // ===== HEADER =====
            $header = $section->addHeader();
            $header->addText(
                'LAPORAN AKHIR KEGIATAN E-LITBANG',
                ['bold' => true, 'size' => 12],
                ['alignment' => 'center']
            );
            $header->addText(
                'Pemerintah Kota - Badan Penelitian dan Pengembangan',
                ['size' => 10],
                ['alignment' => 'center']
            );
            
            // ===== TITLE =====
            $section->addText(
                'LAPORAN AKHIR KEGIATAN',
                ['bold' => true, 'size' => 16, 'underline' => 'single'],
                ['alignment' => 'center', 'spaceAfter' => 240]
            );
            
            $section->addText(
                strtoupper($laporan->judul_kegiatan),
                ['bold' => true, 'size' => 14],
                ['alignment' => 'center', 'spaceAfter' => 480]
            );
            
            // ===== INFO DASAR =====
            $this->addSectionTitle($section, 'I. INFORMASI DASAR');
            
            $infoTable = $section->addTable([
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 80,
                'width' => 100 * 50
            ]);
            
            $this->addTableRow($infoTable, 'Jenis Kegiatan', $laporan->jenis_kegiatan);
            $this->addTableRow($infoTable, 'Penanggung Jawab', $laporan->penanggung_jawab);
            $this->addTableRow($infoTable, 'OPD', $laporan->user->nama_opd ?? $laporan->user->name);
            $this->addTableRow($infoTable, 'Tahun Pelaksanaan', $laporan->tahun_pelaksanaan);
            $this->addTableRow($infoTable, 'Lokasi Kegiatan', $laporan->lokasi_kegiatan);
            $this->addTableRow($infoTable, 'Periode', 
                $laporan->tanggal_mulai->format('d/m/Y') . ' s/d ' . $laporan->tanggal_selesai->format('d/m/Y')
            );
            $this->addTableRow($infoTable, 'Anggaran', 'Rp ' . number_format($laporan->anggaran, 0, ',', '.'));
            $this->addTableRow($infoTable, 'Persentase Realisasi', $laporan->persentase_realisasi . '%');
            $this->addTableRow($infoTable, 'Status', strtoupper($laporan->status));
            
            $section->addTextBreak(1);
            
            // ===== LATAR BELAKANG =====
            $this->addSectionTitle($section, 'II. LATAR BELAKANG');
            $section->addText(
                $laporan->latar_belakang,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== TUJUAN =====
            $this->addSectionTitle($section, 'III. TUJUAN KEGIATAN');
            $section->addText(
                $laporan->tujuan_kegiatan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== METODE =====
            $this->addSectionTitle($section, 'IV. METODE PELAKSANAAN');
            $section->addText(
                $laporan->metode_pelaksanaan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== TAHAPAN =====
            $this->addSectionTitle($section, 'V. TAHAPAN PELAKSANAAN');
            $section->addText(
                $laporan->tahapan_pelaksanaan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== OUTPUT =====
            $this->addSectionTitle($section, 'VI. OUTPUT KEGIATAN');
            $section->addText(
                $laporan->output_kegiatan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== HASIL =====
            $this->addSectionTitle($section, 'VII. HASIL KEGIATAN');
            $section->addText(
                $laporan->hasil_kegiatan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== KENDALA =====
            $this->addSectionTitle($section, 'VIII. KENDALA PELAKSANAAN');
            $section->addText(
                $laporan->kendala_pelaksanaan,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== SOLUSI =====
            $this->addSectionTitle($section, 'IX. SOLUSI KENDALA');
            $section->addText(
                $laporan->solusi_kendala,
                ['size' => 11],
                ['alignment' => 'both', 'spaceAfter' => 240]
            );
            
            // ===== VERIFIKASI (jika sudah diverifikasi) =====
            if ($laporan->tanggal_verifikasi) {
                $section->addPageBreak();
                $this->addSectionTitle($section, 'X. VERIFIKASI');
                
                $verifikasiTable = $section->addTable([
                    'borderSize' => 6,
                    'borderColor' => '000000',
                    'cellMargin' => 80
                ]);
                
                $this->addTableRow($verifikasiTable, 'Tanggal Verifikasi', 
                    $laporan->tanggal_verifikasi->format('d F Y H:i')
                );
                $this->addTableRow($verifikasiTable, 'Diverifikasi Oleh', 
                    $laporan->verifiedBy->name ?? '-'
                );
                $this->addTableRow($verifikasiTable, 'Catatan Admin', 
                    $laporan->catatan_admin ?? '-'
                );
            }
            
            // ===== FOOTER =====
            $footer = $section->addFooter();
            $footer->addPreserveText(
                'Halaman {PAGE} dari {NUMPAGES}',
                ['size' => 9],
                ['alignment' => 'center']
            );
            $footer->addText(
                'Dicetak pada: ' . date('d F Y H:i'),
                ['size' => 8, 'italic' => true],
                ['alignment' => 'center']
            );
            
            // Save to file
            $filename = 'Laporan_' . str_replace(' ', '_', $laporan->judul_kegiatan) . '_' . date('YmdHis') . '.docx';
            $tempFile = storage_path('app/public/temp/' . $filename);
            
            // Create temp directory if not exists
            if (!file_exists(storage_path('app/public/temp'))) {
                mkdir(storage_path('app/public/temp'), 0777, true);
            }
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);
            
            // Download file
            return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
            
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Gagal export Word: ' . $th->getMessage());
        }
    }
    
    /**
     * Helper: Check Export Authorization
     */
    private function checkExportAuthorization($laporan)
    {
        $user = auth()->user();
        
        // Admin bisa export semua
        if ($user->hasRole('superadmin')) {
            return true;
        }
        
        // OPD hanya bisa export milik sendiri
        if ($user->hasRole('opd')) {
            if ($laporan->user_id !== $user->id) {
                abort(403, 'Anda tidak memiliki akses untuk export laporan ini.');
            }
            
            // OPD hanya bisa export yang sudah diterima
            if (!in_array($laporan->status, ['diterima'])) {
                abort(403, 'Hanya laporan yang sudah diterima yang dapat dicetak.');
            }
            
            return true;
        }
        
        abort(403, 'Unauthorized action.');
    }
    
    /**
     * Helper: Add Section Title
     */
    private function addSectionTitle($section, $title)
    {
        $section->addText(
            $title,
            ['bold' => true, 'size' => 13, 'color' => '1F4788'],
            ['spaceAfter' => 120]
        );
    }
    
    /**
     * Helper: Add Table Row
     */
    private function addTableRow($table, $label, $value)
    {
        $table->addRow();
        $table->addCell(4000)->addText($label, ['bold' => true, 'size' => 11]);
        $table->addCell(6000)->addText($value, ['size' => 11]);
    }
}