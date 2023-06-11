<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_Question extends Model
{
    use HasFactory;

    // 520 741 8
    // model refereciando a table de Question e Quiz.
    //N para N
    protected $table = 'quiz_question';
}
