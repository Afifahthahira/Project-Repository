<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = 'raks';
    protected $primaryKey = 'id_rak';
    public $timestamps = false;

    protected $fillable = [
        'nama_rak'
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_rak', 'id_rak');
    }
}
