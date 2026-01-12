<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TentangController extends Controller
{
    public function index()
    {
        $tentangs = Tentang::orderBy('urutan')->paginate(10);
        return view('admin.tentang.index', compact('tentangs'));
    }

    public function create()
    {
        return view('admin.tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tentang', $filename, 'public');
            $data['gambar'] = 'tentang/' . $filename;
        }

        $data['status'] = $request->has('status');

        Tentang::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data tentang berhasil ditambahkan'
        ]);
    }

    public function show(Tentang $tentang)
    {
        return view('admin.tentang.show', compact('tentang'));
    }

    public function edit(Tentang $tentang)
    {
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(Request $request, Tentang $tentang)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($tentang->gambar && Storage::disk('public')->exists($tentang->gambar)) {
                Storage::disk('public')->delete($tentang->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tentang', $filename, 'public');
            $data['gambar'] = 'tentang/' . $filename;
        }

        $data['status'] = $request->has('status');

        $tentang->update($data);

        return redirect()->route('tentang.admin.index')->with('success', 'Data tentang berhasil diperbarui');
    }

    public function destroy(Tentang $tentang)
    {
        // Delete image file
        if ($tentang->gambar && Storage::disk('public')->exists($tentang->gambar)) {
            Storage::disk('public')->delete($tentang->gambar);
        }

        $tentang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data tentang berhasil dihapus'
        ]);
    }
}
