<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class keluarga_user extends Model
{
    use HasFactory;
    protected $table = 'keluarga_user';
    protected $fillable = [
        'id_user',
        'status',
        'nama',
        'telp',
        'ttl',
        'tl',
        'pendidikan',
        'pekerjaan',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
