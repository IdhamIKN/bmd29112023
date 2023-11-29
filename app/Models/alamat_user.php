<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class alamat_user extends Model
{
    use HasFactory;

    protected $table = 'alamat_user';
    protected $fillable = [
        'id_user',
        'jenis',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'alamat',
        'kodepos',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
