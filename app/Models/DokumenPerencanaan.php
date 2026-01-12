<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenPerencanaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokumen_perencanaan';

    protected $fillable = [
        'judul',
        'jenis',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'tahun',
        'status',
        'is_online',
        'visibility',
        'uploaded_by',
        'published_at'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'file_size' => 'integer',
        'is_online' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function opdTerpilih()
{
    return $this->belongsToMany(User::class, 'dokumen_opd', 'dokumen_id', 'opd_id')
                ->withPivot('is_read', 'read_at')
                ->withTimestamps()
                ->using(DokumenOpdPivot::class); // Gunakan custom pivot model
}

    // Scopes - PERBAIKAN: Tambahkan prefix tabel
    public function scopePublished($query)
    {
        return $query->where('dokumen_perencanaan.status', 'published');
    }

    public function scopeOnline($query)
    {
        return $query->where('dokumen_perencanaan.is_online', true);
    }

    public function scopeForYear($query, $year)
    {
        return $query->where('dokumen_perencanaan.tahun', $year);
    }

    // Helpers
    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function getFileSizeFormatted()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }

    // PERBAIKAN: Tambahkan prefix tabel pada where clause
    public function canBeViewedByOpd($opdId)
    {
        if (!$this->isPublished()) {
            return false;
        }

        if ($this->visibility === 'semua_opd') {
            return true;
        }

        if ($this->visibility === 'opd_terpilih') {
            return $this->opdTerpilih()
                        ->where('dokumen_opd.opd_id', $opdId)
                        ->exists();
        }

        return false;
    }

    // Tambahkan method baru di bagian Helpers
public function getReadStatusForOpd($opdId)
{
    if ($this->visibility !== 'opd_terpilih') {
        return null;
    }

    // Cek dari relasi yang sudah di-load (eager loading)
    if ($this->relationLoaded('opdTerpilih')) {
        $opd = $this->opdTerpilih->firstWhere('id', $opdId);
        return $opd ? $opd->pivot : null;
    }
    
    // Fallback: query langsung dengan prefix tabel
    return $this->opdTerpilih()
                ->where('dokumen_opd.opd_id', $opdId)
                ->first()?->pivot;
}


}