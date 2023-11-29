<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class pendnformal_user extends Model
{
    use HasFactory;
    protected $table = 'pendnformal_user';
    protected $fillable = [
        'id_user',
        'lembaga',
        'kota',
        'mulai',
        'selesai',
        'sertif',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
