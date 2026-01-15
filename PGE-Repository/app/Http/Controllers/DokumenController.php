<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\Divisi;
use App\Models\Rak;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    // ============================
    //      PUBLIC (TANPA LOGIN)
    // ============================
    public function showPublic($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Log activity jika user sudah login
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::user()->id_user,
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'viewed',
                'ip_address' => request()->ip(),
            ]);
        }

        return view('public.view', compact('dokumen'));
    }

    public function publicSearch(Request $request)
    {
        $keyword = $request->q;

        $dokumen = Dokumen::where('judul', 'like', "%$keyword%")
            ->orderBy('id_dokumen', 'DESC')
            ->get();

        return view('public.search', compact('dokumen', 'keyword'));
    }



    // ============================
    //            ADMIN
    // ============================

    public function index()
    {
        $dokumen = Dokumen::with(['kategori', 'rak', 'divisi'])->get();
        $kategoris = Kategori::all();
        $raks = Rak::all();
        $divisis = Divisi::all();

        return view('admin.dokumen', compact('dokumen', 'kategoris', 'raks', 'divisis'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $rak = Rak::all();
        $divisi = Divisi::all();

        return view('dokumen.create', compact('kategori', 'rak', 'divisi'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string',
            'id_kategori'  => 'required|exists:kategoris,id_kategori',
            'id_rak'       => 'required|exists:raks,id_rak',
            'id_divisi'    => 'required|exists:divisis,id_divisi',
            'no_versi'     => 'nullable|string',
            'status'       => 'required|in:aktif,nonaktif',
            'tahun_masuk'  => 'required|string|max:10',
            'file'         => 'required|mimes:pdf,doc,docx,xlsx,ppt,pptx'
        ]);

        // Upload file
        $file = $request->file('file');
        $filePath = $file->store('dokumen', 'public');

        $dokumen = Dokumen::create([
            'judul'      => $request->nama_dokumen,
            'file_path'    => $filePath,
            'id_kategori'  => $request->id_kategori,
            'id_rak'       => $request->id_rak,
            'id_divisi'    => $request->id_divisi,
            'no_versi'     => $request->no_versi,
            'status'       => $request->status,
            'tahun_masuk'  => $request->tahun_masuk
        ]);

        // Log activity
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::id(),
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'uploaded',
                'ip_address' => $request->ip(),
            ]);
        }

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function view($id)
    {
        $dokumen = Dokumen::with(['kategori', 'rak', 'divisi'])->findOrFail($id);

        // Log activity
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::id(),
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'viewed',
                'ip_address' => request()->ip(),
            ]);
        }

        return view('admin.view-dokumen', compact('dokumen'));
    }


    public function edit($id)
    {
        $dokumen = Dokumen::with(['kategori', 'rak', 'divisi'])->findOrFail($id);
        return response()->json($dokumen);
    }



    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required|string',
            'id_kategori'  => 'required|exists:kategoris,id_kategori',
            'id_rak'       => 'required|exists:raks,id_rak',
            'id_divisi'    => 'required|exists:divisis,id_divisi',
            'no_versi'     => 'nullable|string',
            'status'       => 'required|in:aktif,nonaktif',
            'tahun_masuk'  => 'required|string|max:10',
            'file'         => 'nullable|mimes:pdf,doc,docx,xlsx,ppt,pptx'
        ]);

        $data = [
            'judul' => $request->nama_dokumen,
            'id_kategori'  => $request->id_kategori,
            'id_rak'       => $request->id_rak,
            'id_divisi'    => $request->id_divisi,
            'no_versi'     => $request->no_versi,
            'status'       => $request->status,
            'tahun_masuk'  => $request->tahun_masuk,
        ];

        if ($request->hasFile('file')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('dokumen', 'public');
        }

        $dokumen->update($data);

        // Log activity
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::id(),
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'edited',
                'ip_address' => $request->ip(),
            ]);
        }

        return redirect()->route('admin.dokumen')->with('success', 'Dokumen berhasil diperbarui');
    }


    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Log activity sebelum delete
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::id(),
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'deleted',
                'ip_address' => request()->ip(),
            ]);
        }

        // Hapus file fisik jika ada
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        // Hapus record databasenya
        $dokumen->delete();

        return redirect()->route('admin.dokumen')
            ->with('success', 'Dokumen berhasil dihapus');
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Log activity
        if (Auth::check()) {
            Aktivitas::create([
                'user_id' => Auth::user()->id_user,
                'dokumen_id' => $dokumen->id_dokumen,
                'action' => 'downloaded',
                'ip_address' => request()->ip(),
            ]);
        }

        $filePath = storage_path('app/public/' . $dokumen->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath, $dokumen->judul . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
