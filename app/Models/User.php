<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

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
        'role_id',
        'bio',
        'jenis_kelamin',
        'tanggal_lahir',
        // 'role',
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

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['id_user'];
    }
}
