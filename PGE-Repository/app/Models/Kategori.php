<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'nama_kategori'
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_kategori', 'id_kategori');
    }
}
