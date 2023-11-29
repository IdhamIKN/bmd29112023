<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Contracts\HasRoles as HasRolesContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Middleware\Authorize;
use App\Models\pendidikan_user;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'nohp',
        'divisi',
        'gender',
        'active',
        'lastlogin',
        'photo',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that appends to returned entities.
     *
     * @var array
     */
    protected $appends = ['photo'];

    /**
     * The getter that return accessible URL for user photo.
     *
     * @var array
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->foto !== null) {
            return url('media/user/' . $this->id . '/' . $this->foto);
        } else {
            return url('media-example/no-image.png');
        }
    }

    public function getPhotoAttribute($value)
    {
        // Check if the 'photo' attribute is not empty and then append 'storage/' to the URL
        if (!empty($value)) {
            return asset('storage/' . $value);
        }

        // If the 'photo' attribute is empty, provide a default image URL
        return asset('build/assets/images/user.png');
    }

    public function pendidikan_user()
    {
        return $this->hasMany(pendidikan_user::class, 'id_user');
    }

    public function alamatUser()
    {
        return $this->hasOne('App\Models\alamat_user', 'id_user');
    }

    public function bahasaUser()
    {
        return $this->hasOne('App\Models\bahasa_user', 'id_user');
    }

    public function info_user()
    {
        return $this->hasOne('App\Models\info_user', 'id_user');
    }

    public function keluarga_user()
    {
        return $this->hasOne('App\Models\keluarga_user', 'id_user');
    }
    public function kontak_user()
    {
        return $this->hasOne('App\Models\kontak_user', 'id_user');
    }
    public function organisasi_user()
    {
        return $this->hasOne('App\Models\organisasi_user', 'id_user');
    }
    public function pendidikanuser()
    {
        return $this->hasOne('App\Models\pendidikan_user', 'id_user');
    }
    public function pendnformal_user()
    {
        return $this->hasOne('App\Models\pendnformal_user', 'id_user');
    }


    protected static function boot() 
    {
        parent::boot();

        // Aktifkan Cascade On Delete
        static::deleting(function($user) {
            $user->alamatUser()->delete();
            $user->bahasaUser()->delete();
            $user->info_user()->delete();
            $user->keluarga_user()->delete();
            $user->kontak_user()->delete();
            $user->organisasi_user()->delete();
            $user->pendidikanuser()->delete();
            $user->pendnformal_user()->delete();
            $user->pendnformal_user()->delete();
        });
    }
}

