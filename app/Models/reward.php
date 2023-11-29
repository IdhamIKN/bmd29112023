<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reward extends Model
{
    use HasFactory;
    protected $table = 'reward';
    protected $fillable = [
        'pemberi',
        'reward',
        'tanggal',
        'karyawan',
        'ket',
        'created_at',
        'updated_at'
    ];
}
