<?php

namespace App\Notifications;

use App\Models\LaporanAkhir;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanAkhirUploaded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public LaporanAkhir $laporan;
    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Laporan Akhir Telah Diupload')
            ->greeting('Halo Superadmin')
            ->line('OPD Pengusul ' . $this->laporan->user->name . ' telah mengupload laporan akhir ')
            ->line('Judul : ' . $this->laporan->judul)
            ->action('Lihat Laporan', url('/'))
            ->line('Silakan cek sistem untuk menindaklanjuti laporan ini')
            ->line('Terimakasih');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Laporan Akhir Baru',
            'message' => 'OPD ' . $this->laporan->user->name . ' mengupload laporan akhir',
            'judul' => $this->laporan->judul_kegiatan,
            'opd' => $this->laporan->user->name,
            'laporan_id' => $this->laporan->id ?? null,
        ];
    }
}
