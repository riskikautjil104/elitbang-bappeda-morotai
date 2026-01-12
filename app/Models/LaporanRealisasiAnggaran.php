<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRealisasiAnggaran extends Model
{
    use HasFactory;

    protected $table = 'laporan_realisasi_anggarans';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'anggaran',
        'realisasi',
        'tanggal_kegiatan',
        'lokasi',
        'file_pendukung',
        'keterangan',
    ];

    protected $casts = [
        'anggaran' => 'decimal:2',
        'realisasi' => 'decimal:2',
        'tanggal_kegiatan' => 'date',
        'file_pendukung' => 'array',
    ];

    /**
     * Accessor untuk hitung persentase realisasi
     */
    public function getPersentaseRealisasiAttribute()
    {
        if ($this->anggaran == 0) return 0;
        return round(($this->realisasi / $this->anggaran) * 100, 1);
    }

    /**
     * Accessor untuk format anggaran
     */
    public function getAnggaranFormattedAttribute()
    {
        return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
    }

    /**
     * Accessor untuk format realisasi
     */
    public function getRealisasiFormattedAttribute()
    {
        return 'Rp ' . number_format($this->realisasi, 0, ',', '.');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_kegiatan', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%")
              ->orWhere('lokasi', 'like', "%{$search}%");
        });
    }

    /**
     * Scope untuk filter bulan
     */
    public function scopeByMonth($query, $month, $year = null)
    {
        $year = $year ?? date('Y');
        return $query->whereMonth('tanggal_kegiatan', $month)
                     ->whereYear('tanggal_kegiatan', $year);
    }

    /**
     * Scope untuk filter tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('tanggal_kegiatan', $year);
    }

    /**
     * Get total anggaran
     */
    public static function totalAnggaran()
    {
        return self::sum('anggaran');
    }

    /**
     * Get total realisasi
     */
    public static function totalRealisasi()
    {
        return self::sum('realisasi');
    }

    /**
     * Get total persentase realisasi
     */
    public static function totalPersentaseRealisasi()
    {
        $totalAnggaran = self::totalAnggaran();
        if ($totalAnggaran == 0) return 0;
        return round((self::totalRealisasi() / $totalAnggaran) * 100, 1);
    }
}

