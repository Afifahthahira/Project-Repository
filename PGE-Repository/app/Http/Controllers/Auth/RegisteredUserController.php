<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $divisis = Divisi::all();
        return view('auth.register', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'id_divisi' => 'nullable|exists:divisis,id_divisi',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_divisi' => $request->id_divisi,
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
