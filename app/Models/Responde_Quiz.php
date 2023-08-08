<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responde_Quiz extends Model
{
    use HasFactory;
    //responde_quiz
    protected $table = 'responde_quiz';

    protected $dates = ['date'];
    //deixa atulizar tudo
    protected $guarded = [];
}
