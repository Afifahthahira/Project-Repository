<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Support\Facades\DB;

class CreateFilamentUser extends Command
{
    protected $signature = 'create:user';

    protected $description = 'Membuat user baru sesuai struktur tabel User';

    public function handle()
    {
        $nama = $this->ask('Nama lengkap');
        $email = $this->ask('Email');

        // Ambil daftar divisi jika tabel divisi tersedia
        $divisiList = DB::table('divisis')->pluck('nama_divisi', 'id_divisi')->toArray();

        $id_divisi = empty($divisiList)
            ? $this->ask('ID Divisi (kosongkan jika tidak ada)')
            : $this->choice('Pilih Divisi', array_map(fn($v,$k)=>"$k - $v", $divisiList, array_keys($divisiList)));

        // Convert pilihan "id - nama" menjadi id asli
        if ($id_divisi && str_contains($id_divisi, ' - ')) {
            $id_divisi = explode(' - ', $id_divisi)[0];
        }

        $role = $this->choice('Role', ['admin', 'user'], 2); // default user

        $password = $this->secret('Password');

        $user = User::create([
            'nama' => $nama,
            'email' => $email,
            'id_divisi' => $id_divisi ?: null,
            'role' => $role,
            'password' => Hash::make($password),
        ]);

        $this->info("✅ User {$user->email} berhasil dibuat dengan role: {$user->role}");
    }
}
