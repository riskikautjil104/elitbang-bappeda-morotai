<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'opd_id',
        'nama_opd',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ========================================
     * RELATIONSHIPS
     * ========================================
     */

    /**
     * Relasi ke laporan akhir
     * User (OPD) bisa memiliki banyak laporan
     */
    public function laporans()
    {
        return $this->hasMany(LaporanAkhir::class, 'user_id');
    }

    /**
     * Relasi ke Laporan yang sudah diverifikasi oleh user ini (admin)
     */
    public function verifiedLaporan()
    {
        return $this->hasMany(LaporanAkhir::class, 'verified_by');
    }

    /**
     * Relasi ke OPD
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    /**
     * ========================================
     * SCOPES
     * ========================================
     */

    /**
     * Scope untuk filter OPD saja
     */
    public function scopeOpd($query)
    {
        return $query->role('opd');
    }

    /**
     * Scope untuk filter Admin saja
     */
    public function scopeAdmin($query)
    {
        return $query->role('superadmin');
    }

    /**
     * Scope untuk OPD yang aktif (ada laporan 3 bulan terakhir)
     */
    public function scopeActive($query)
    {
        return $query->whereHas('laporans', function($q) {
            $q->where('created_at', '>=', now()->subMonths(3));
        });
    }

    /**
     * Scope untuk OPD yang tidak aktif
     */
    public function scopeInactive($query)
    {
        return $query->whereDoesntHave('laporans', function($q) {
            $q->where('created_at', '>=', now()->subMonths(3));
        });
    }

    /**
     * ========================================
     * ACCESSORS
     * ========================================
     */

    /**
     * Get formatted phone number
     */
    public function getFormattedPhoneAttribute()
    {
        if (!$this->no_telp) return '-';
        
        $phone = preg_replace('/[^0-9]/', '', $this->no_telp);
        return preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $phone);
    }

    /**
     * Get total laporan count
     */
    public function getTotalLaporanAttribute()
    {
        return $this->laporans()->count();
    }

    /**
     * Get approved laporan count
     */
    public function getApprovedLaporanAttribute()
    {
        return $this->laporans()->where('status', 'disetujui')->count();
    }

    /**
     * Get pending laporan count
     */
    public function getPendingLaporanAttribute()
    {
        return $this->laporans()->where('status', 'diajukan')->count();
    }

    /**
     * Get success rate percentage
     */
    public function getSuccessRateAttribute()
    {
        $total = $this->total_laporan;
        if ($total == 0) return 0;

        $approved = $this->approved_laporan;
        return round(($approved / $total) * 100, 1);
    }

    /**
     * ========================================
     * HELPER METHODS
     * ========================================
     */

    /**
     * Check if user is OPD
     */
    public function isOpd()
    {
        return $this->hasRole('opd');
    }

    /**
     * Check if user is Admin
     */
    public function isAdmin()
    {
        return $this->hasRole('superadmin');
    }
}