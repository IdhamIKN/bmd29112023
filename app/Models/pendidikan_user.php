<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class pendidikan_user extends Model
{
    use HasFactory;
    protected $table = 'pendidikan_user';
    protected $fillable = [
        'id_user',
        'jenjang',
        'sekolah',
        'jurusan',
        'kota',
        'mulai',
        'selesai',
        'status',
        'ipk',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // public function pendidikan_user()
    // {
    //     return $this->hasMany(pendidikan_user::class);
    // }
}

