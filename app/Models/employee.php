<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'nik',
        'name',
        'ktp',
        'ttl',
        'tl',
        'warga',
        'agama',
        'goldar',
        'stper',
        'alamat',
        'kec',
        'kota',
        'prov',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
