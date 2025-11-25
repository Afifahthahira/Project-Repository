<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'aktivitas';
    protected $primaryKey = 'id_aktivitas';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'dokumen_id',
        'action',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id', 'id_dokumen');
    }
}
