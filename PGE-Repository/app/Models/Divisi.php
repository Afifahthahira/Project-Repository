<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';
    protected $primaryKey = 'id_divisi';
    protected $fillable = ['nama_divisi'];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_divisi', 'id_divisi');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_divisi', 'id_divisi');
    }
}
