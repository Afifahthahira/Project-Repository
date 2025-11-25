<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    public function index()
    {
        $divisis = Divisi::withCount(['dokumen', 'users'])
            ->orderBy('nama_divisi')
            ->get();

        return view('admin.divisi', compact('divisis'));
    }

    public function create()
    {
        return view('admin.divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:150',
        ]);

        Divisi::create([
            'nama_divisi' => $request->nama_divisi
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);

        return view('admin.divisi.edit', compact('divisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:150',
        ]);

        $divisi = Divisi::findOrFail($id);

        $divisi->update([
            'nama_divisi' => $request->nama_divisi
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
        
        // Cek apakah masih ada dokumen dalam divisi ini
        if ($divisi->dokumen()->count() > 0) {
            return back()->with('error', 'Divisi tidak dapat dihapus karena masih memiliki dokumen.');
        }
        
        $divisi->delete();

        return back()->with('success', 'Divisi berhasil dihapus.');
    }
}
