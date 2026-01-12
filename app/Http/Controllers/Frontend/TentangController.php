<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        // Ambil data tentang yang aktif, diurutkan berdasarkan urutan
        $tentangs = Tentang::active()->ordered()->get();
        
        return view('frondend.tentang.index', compact('tentangs'));
    }
}