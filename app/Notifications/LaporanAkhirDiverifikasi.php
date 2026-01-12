<?php

namespace App\Notifications;

use App\Models\LaporanAkhir;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LaporanAkhirDiverifikasi extends Notification
{
    use Queueable;

    protected $laporan;

    public function __construct(LaporanAkhir $laporan)
    {
        $this->laporan = $laporan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $statusText = [
            'diterima' => 'diterima',
            'revisi' => 'perlu direvisi',
            'ditolak' => 'ditolak'
        ];

        return [
            'title' => 'Laporan ' . $statusText[$this->laporan->status],
            'message' => 'Laporan "' . $this->laporan->judul_kegiatan . '" telah ' . $statusText[$this->laporan->status] . ' oleh admin. Silakan cek catatan.',
            'laporan_id' => $this->laporan->id,
            'status' => $this->laporan->status,
        ];
    }
}