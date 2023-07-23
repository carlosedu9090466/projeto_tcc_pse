<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
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

    public function userEscolar()
    {
        //um user para userEscolar
        return $this->hasOne('App\Models\UserEscolar');
    }

    public function UserEscolarVinculo()
    {
        //um UserEscolar pode ser vinculado em várias Escolas
        return $this->belongsToMany(Escola::class, 'escola_users', 'user_id', 'escola_id');
        //return $this->belongsToMany('App\Models\Escola');
    }

    public function getRole()
    {

        return $this->role_id;
    }
}
