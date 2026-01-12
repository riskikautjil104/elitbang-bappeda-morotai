<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'label',
        'nilai',
        'icon',
        'urutan',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope untuk urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}