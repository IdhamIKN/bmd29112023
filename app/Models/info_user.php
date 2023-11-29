<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class info_user extends Model
{
    use HasFactory;

    protected $table = 'info_user';

    protected $fillable = [
        'id_user',
        'nik',
        'name',
        'ktp',
        'penempatan',
        'divisi',
        'ttl',
        'tl',
        'jk',
        'warga',
        'agama',
        'goldar',
        'stper',
        'foto',
        'created_at',
        'updated_at'

    ];

    protected $casts = [
        'ttl' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function info_user()
    {
        return $this->hasOne(InfoUser::class);
    }
}
