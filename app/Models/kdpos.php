<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kdpos extends Model
{
    use HasFactory;

    protected $fillable = [
        'postal',
        'code',
        'slug',
        'province',
        'city',
        'district',
        'village',
        'latitude',
        'longitude',
        'elevation',
        'geometry',
    ];
}
