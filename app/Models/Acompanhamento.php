<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompanhamento extends Model
{
    use HasFactory;

    protected $table = 'acompanhamentos';

    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];
}
