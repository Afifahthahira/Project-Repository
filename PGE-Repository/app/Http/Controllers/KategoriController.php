<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::withCount('dokumen')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.kategori', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:150',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:150',
        ]);

        $category = Kategori::findOrFail($id);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        
        // Cek apakah masih ada dokumen dalam kategori ini
        if ($category->dokumen()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki dokumen.');
        }
        
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
