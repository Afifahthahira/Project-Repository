<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('divisi');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by division
        if ($request->has('division') && $request->division) {
            $query->where('id_divisi', $request->division);
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status (using created_at as placeholder, bisa diganti dengan field status jika ada)
        // Untuk sekarang kita anggap semua user aktif

        $users = $query->orderBy('nama')->get();

        // Statistics
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $activeUsers = User::count(); // Asumsi semua user aktif

        $divisis = Divisi::orderBy('nama_divisi')->get();

        return view('admin.users', compact('users', 'totalUsers', 'totalAdmins', 'activeUsers', 'divisis'));
    }

    public function create()
    {
        $divisis = Divisi::orderBy('nama_divisi')->get();
        return view('admin.users.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'id_divisi' => 'nullable|exists:divisis,id_divisi',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_divisi' => $request->id_divisi,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $divisis = Divisi::orderBy('nama_divisi')->get();
        return view('admin.users.edit', compact('user', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id_user',
            'password' => 'nullable|string|min:6',
            'id_divisi' => 'nullable|exists:divisis,id_divisi',
            'role' => 'required|in:admin,user',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'id_divisi' => $request->id_divisi,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if ($user->id_user == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }
        
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
