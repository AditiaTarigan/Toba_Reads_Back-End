<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
<<<<<<< HEAD
        'role_id',
=======
        'bio',
        'jenis_kelamin',
        'tanggal_lahir',
        'role',
>>>>>>> 8b49cacd0caf28484b6dbb5034e1e644ba5506d5
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_user');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function favorit()
    {
        return $this->hasMany(Favorit::class, 'id_user');
    }

    public function karya()
    {
        return $this->hasMany(KaryaUser::class, 'id_user');
    }

    public function hasilKuis()
    {
        return $this->hasMany(HasilKuis::class, 'id_user');
    }
}
