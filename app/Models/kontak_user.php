<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class kontak_user extends Model
{
    use HasFactory;
    protected $table = 'kontak_user';
    protected $fillable = [
        'id_user',
        'nama',
        'hubungan',
        'alamat',
        'telp',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
