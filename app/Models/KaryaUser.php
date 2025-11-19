<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaUser extends Model
{
    protected $table = 'karya_user';
    protected $primaryKey = 'id_karya';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'judul',
        'isi',
        'file_lampiran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
