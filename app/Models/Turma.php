<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $guarded = [];

    public function TurmasEscola()
    {
        //1:1
        //$this->hasOne('App\Models\Escola');
        //N:1
        $this->belongsTo('App\Models\Escola');
    }
}
