<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $table = 'alunos';
    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];


    public function Alunoturma()
    {

        //return $this->hasOne('App\Models\Turma');

        return $this->belongsToMany(Turma::class, 'turma_aluno', 'id_aluno', 'id_turma');
    }
}
