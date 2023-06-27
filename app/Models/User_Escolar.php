<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Escolar extends Model
{
    use HasFactory;

    protected $table = 'escola_users';

    protected $fillable = ['user_id', 'escola_id', 'status_user_escolar'];

    protected $guarded = [];
}
