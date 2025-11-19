<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    public $timestamps = true;

    protected $fillable = [
        'judul',
        'id_penulis',
        'id_kategori',
        'deskripsi',
        'file_buku',
        'cover',
        'status',
    ];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'id_kategori');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_buku');
    }

    public function favorit()
    {
        return $this->hasMany(Favorit::class, 'id_buku');
    }
}
