<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $table = 'laporan_akhirs';
    
    protected $fillable = [
        'user_id',
        'jenis_kegiatan',
        'judul_kegiatan',
        'penanggung_jawab',
        'tahun_pelaksanaan',
        'lokasi_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'anggaran',
        'latar_belakang',
        'tujuan_kegiatan',
        'metode_pelaksanaan',
        'tahapan_pelaksanaan',
        'output_kegiatan',
        'hasil_kegiatan',
        'persentase_realisasi',
        'kendala_pelaksanaan',
        'solusi_kendala',
        'file_laporan',
        'file_dokumentasi',
        'file_data_pendukung',
        'file_sk',
        'file_pemaparan',
        'status',
        'is_draft',
        'is_published',
        'is_archived',
        'tanggal_arsip',
        'catatan_admin',
        'tanggal_verifikasi',
        'verified_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_verifikasi' => 'datetime',
        'tanggal_arsip' => 'datetime',
        'anggaran' => 'decimal:2',
        'persentase_realisasi' => 'integer',
        'is_draft' => 'boolean',
        'is_published' => 'boolean',
        'is_archived' => 'boolean',
    ];

    protected $appends = [
        'file_dokumentasi_array', 
        'file_data_pendukung_array',
        'anggaranFormatted'
    ];

    /**
     * ========================================
     * RELATIONSHIPS
     * ========================================
     */

    /**
     * Relasi ke User (OPD yang membuat laporan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke User (Admin yang memverifikasi)
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * ========================================
     * ACCESSORS
     * ========================================
     */

    /**
     * Accessor untuk decode file dokumentasi
     */
    public function getFileDokumentasiArrayAttribute()
    {
        if (empty($this->file_dokumentasi)) {
            return [];
        }
        
        $files = json_decode($this->file_dokumentasi, true);
        
        if (is_array($files)) {
            return array_map(function($file) {
                if (str_starts_with($file, 'dokumentasi/')) {
                    return $file;
                }
                return 'dokumentasi/' . $file;
            }, $files);
        }
        
        return [];
    }

    /**
     * Accessor untuk decode file data pendukung
     */
    public function getFileDataPendukungArrayAttribute()
    {
        if (empty($this->file_data_pendukung)) {
            return [];
        }
        
        $files = json_decode($this->file_data_pendukung, true);
        
        if (is_array($files)) {
            return array_map(function($file) {
                if (str_starts_with($file, 'data_pendukung/')) {
                    return $file;
                }
                return 'data_pendukung/' . $file;
            }, $files);
        }
        
        return [];
    }

    /**
     * Get formatted anggaran (contoh: Rp 1.000.000)
     */
    public function getAnggaranFormattedAttribute()
    {
        return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
    }

    /**
     * Get jenis kegiatan label (untuk dropdown jenis kegiatan)
     */
    public function getJenisKegiatanLabelAttribute()
    {
        return match($this->jenis_kegiatan) {
            'penelitian' => 'Penelitian',
            'inovasi' => 'Inovasi',
            'pengembangan' => 'Pengembangan',
            'kegiatan_lainnya' => 'Kegiatan Lainnya',
            default => ucwords(str_replace('_', ' ', $this->jenis_kegiatan))
        };
    }

    /**
     * Get formatted realisasi amount
     */
    public function getFormattedRealisasiAttribute()
    {
        $realisasi = ($this->anggaran * $this->persentase_realisasi) / 100;
        return 'Rp ' . number_format($realisasi, 0, ',', '.');
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'diajukan', 'menunggu verifikasi' => 'warning',
            'disetujui', 'diterima' => 'success',
            'direvisi', 'revisi' => 'danger',
            'ditolak' => 'secondary',
            'draft' => 'info',
            default => 'secondary'
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'diajukan', 'menunggu verifikasi' => 'Menunggu Verifikasi',
            'disetujui', 'diterima' => 'Disetujui',
            'direvisi', 'revisi' => 'Perlu Direvisi',
            'ditolak' => 'Ditolak',
            'draft' => 'Draft',
            default => 'Unknown'
        };
    }

    /**
     * Check if laporan is editable
     */
    public function getIsEditableAttribute()
    {
        return in_array($this->status, ['draft', 'direvisi', 'revisi']);
    }

    /**
     * Get waiting days (untuk laporan pending)
     */
    public function getWaitingDaysAttribute()
    {
        if (!in_array($this->status, ['diajukan', 'menunggu verifikasi'])) return 0;
        return $this->created_at->diffInDays(now());
    }

    /**
     * Get verification duration (hari)
     */
    public function getVerificationDaysAttribute()
    {
        if (!$this->tanggal_verifikasi) return null;
        return $this->created_at->diffInDays($this->tanggal_verifikasi);
    }

    /**
     * Get realisasi amount
     */
    public function getRealisasiAmountAttribute()
    {
        return ($this->anggaran * $this->persentase_realisasi) / 100;
    }

    /**
     * ========================================
     * SCOPES
     * ========================================
     */

    /**
     * Scope untuk laporan yang sudah disetujui
     */
    public function scopeApproved($query)
    {
        return $query->whereIn('status', ['disetujui', 'diterima']);
    }

    /**
     * Scope untuk laporan yang dipublikasikan (ditampilkan di frontend)
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope untuk laporan yang belum dipublikasikan
     */
    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Scope untuk laporan pending
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['diajukan', 'menunggu verifikasi']);
    }

    /**
     * Scope untuk laporan yang perlu revisi
     */
    public function scopeNeedsRevision($query)
    {
        return $query->whereIn('status', ['direvisi', 'revisi']);
    }

    /**
     * Scope untuk laporan draft
     */
    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    /**
     * Scope untuk laporan by tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun_pelaksanaan', $year);
    }

    /**
     * Scope untuk laporan by OPD
     */
    public function scopeByOpd($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk laporan yang menunggu lama (> 7 hari)
     */
    public function scopeWaitingLong($query)
    {
        return $query->whereIn('status', ['diajukan', 'menunggu verifikasi'])
            ->where('created_at', '<=', now()->subDays(7));
    }

    /**
     * Scope untuk laporan aktif (bukan draft dan bukan archived)
     */
    public function scopeActive($query)
    {
        return $query->where('is_draft', false)
                     ->whereNotIn('status', ['diterima', 'ditolak']);
    }

    /**
     * Scope untuk laporan archived
     */
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    /**
     * Scope untuk laporan yang tidak diarsipkan
     */
    public function scopeNotArchived($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope untuk filter berdasarkan tab
     */
    public function scopeFilterByTab($query, $tab)
    {
        return match($tab) {
            'menunggu' => $query->whereIn('status', ['diajukan', 'menunggu verifikasi']),
            'diterima' => $query->where('status', 'diterima')->where('is_archived', false),
            'ditolak' => $query->where('status', 'ditolak')->where('is_archived', false),
            'archived' => $query->where('is_archived', true),
            default => $query->where('is_archived', false), // 'semua'
        };
    }

    /**
     * ========================================
     * HELPER METHODS
     * ========================================
     */

    /**
     * Check if laporan is pending
     */
    public function isPending()
    {
        return in_array($this->status, ['diajukan', 'menunggu verifikasi']);
    }

    /**
     * Check if laporan is approved
     */
    public function isApproved()
    {
        return in_array($this->status, ['disetujui', 'diterima']);
    }

    /**
     * Check if laporan needs revision
     */
    public function needsRevision()
    {
        return in_array($this->status, ['direvisi', 'revisi']);
    }

    /**
     * Check if laporan is draft
     */
    public function isDraft()
    {
        return $this->is_draft === true;
    }

    /**
     * Check if laporan is published (ditampilkan di frontend)
     */
    public function isPublished()
    {
        return $this->is_published === true;
    }

    /**
     * Check if laporan is archived
     */
    public function isArchived()
    {
        return $this->is_archived === true;
    }

    /**
     * Archive this laporan
     */
    public function archive()
    {
        $this->update([
            'is_archived' => true,
            'tanggal_arsip' => now(),
        ]);
    }

    /**
     * Unarchive this laporan
     */
    public function unarchive()
    {
        $this->update([
            'is_archived' => false,
            'tanggal_arsip' => null,
        ]);
    }

    /**
     * Toggle archive status
     */
    public function toggleArchive()
    {
        if ($this->is_archived) {
            $this->unarchive();
        } else {
            $this->archive();
        }
        return $this;
    }

    /**
     * Get all file paths as array
     */
    public function getAllFiles()
    {
        $files = [];
        
        if ($this->file_laporan) $files[] = $this->file_laporan;
        if ($this->file_sk) $files[] = $this->file_sk;
        if ($this->file_pemaparan) $files[] = $this->file_pemaparan;
        
        $dokumentasi = json_decode($this->file_dokumentasi, true);
        if (is_array($dokumentasi)) {
            foreach ($dokumentasi as $file) {
                // Cek apakah sudah punya prefix
                if (str_starts_with($file, 'dokumentasi/')) {
                    $files[] = $file;
                } else {
                    $files[] = 'dokumentasi/' . $file;
                }
            }
        }
        
        $dataPendukung = json_decode($this->file_data_pendukung, true);
        if (is_array($dataPendukung)) {
            foreach ($dataPendukung as $file) {
                // Cek apakah sudah punya prefix
                if (str_starts_with($file, 'data_pendukung/')) {
                    $files[] = $file;
                } else {
                    $files[] = 'data_pendukung/' . $file;
                }
            }
        }
        
        return $files;
    }
}