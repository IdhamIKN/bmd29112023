<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class bahasa_user extends Model
{
    use HasFactory;

    protected $table = 'bahasa_user';

    protected $fillable = [
        'id_user',
        'bahasa',
        'lisan',
        'tulisan',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
