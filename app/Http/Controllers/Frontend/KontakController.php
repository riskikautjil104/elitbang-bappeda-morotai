<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        // Ambil data kontak yang aktif, diurutkan berdasarkan urutan
        $kontaks = Kontak::active()->ordered()->get();
        
        return view('frondend.kontak.index', compact('kontaks'));
    }
}