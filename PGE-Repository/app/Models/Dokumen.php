<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $primaryKey = 'id_dokumen';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'file_path',
        'id_kategori',
        'id_rak',
        'id_divisi',
        'no_versi',
        'status',
        'tahun_masuk'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function rak() {
        return $this->belongsTo(Rak::class, 'id_rak', 'id_rak');
    }

    public function divisi() {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
}
