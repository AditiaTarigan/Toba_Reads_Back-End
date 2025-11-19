<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';
    protected $primaryKey = 'id_kuis';
    public $timestamps = true;

    protected $fillable = [
        'judul',
        'deskripsi',
    ];

    public function soal()
    {
        return $this->hasMany(SoalKuis::class, 'id_kuis');
    }

    public function hasil()
    {
        return $this->hasMany(HasilKuis::class, 'id_kuis');
    }
}
