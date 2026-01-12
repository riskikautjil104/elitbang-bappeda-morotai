<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::orderBy('urutan')->paginate(10);
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'nilai' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        Kontak::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data kontak berhasil ditambahkan'
        ]);
    }

    public function show(Kontak $kontak)
    {
        return view('admin.kontak.show', compact('kontak'));
    }

    public function edit(Kontak $kontak)
    {
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'nilai' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        $kontak->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data kontak berhasil diperbarui'
        ]);
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kontak berhasil dihapus'
        ]);
    }
}