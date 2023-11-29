<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class punishment extends Model
{
    use HasFactory;
    protected $table = 'punishment';
    protected $fillable = [
        'pemberi',
        'punishment',
        'tanggal',
        'karyawan',
        'ket',
        'created_at',
        'updated_at'
    ];
}
