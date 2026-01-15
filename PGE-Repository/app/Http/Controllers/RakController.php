<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::withCount('dokumen')
            ->orderBy('nama_rak')
            ->get();

        return view('admin.rak', compact('raks'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required|string|max:150',
        ]);

        Rak::create([
            'nama_rak' => $request->nama_rak
        ]);

        return redirect()->route('admin.rak.index')
            ->with('success', 'Rak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);

        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rak' => 'required|string|max:150',
        ]);

        $rak = Rak::findOrFail($id);

        $rak->update([
            'nama_rak' => $request->nama_rak
        ]);

        return redirect()->route('admin.rak.index')
            ->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        
        // Cek apakah masih ada dokumen dalam rak ini
        if ($rak->dokumen()->count() > 0) {
            return back()->with('error', 'Rak tidak dapat dihapus karena masih memiliki dokumen.');
        }
        
        $rak->delete();

        return back()->with('success', 'Rak berhasil dihapus.');
    }
}
