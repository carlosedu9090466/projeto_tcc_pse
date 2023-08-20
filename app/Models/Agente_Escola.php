<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente_Escola extends Model
{
    use HasFactory;

    protected $table = 'agentes_escolas';
    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];
}
