<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class organisasi_user extends Model
{
    use HasFactory;

    protected $table = 'organisasi_user';

    protected $fillable = [
        'id_user',
        'organisasi',
        'th1',
        'th2',
        'jabatan',
        'ket',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

