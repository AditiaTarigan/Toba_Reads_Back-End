<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $table = 'penulis';
    protected $primaryKey = 'id_penulis';
    public $timestamps = false;

    protected $fillable = [
        'nama_penulis',
        'bio',
        'foto',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_penulis');
    }
}
