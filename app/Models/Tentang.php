<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tentangs';

    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'urutan',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer'
    ];

    // Scope untuk data yang aktif saja
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope untuk sorting berdasarkan urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}