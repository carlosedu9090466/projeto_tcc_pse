<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $guarded = [];

    protected $dates = ['date'];

    public function TurmasEscola()
    {
        //1:1
        //$this->hasOne('App\Models\Escola');
        //N:1
        return $this->belongsTo('App\Models\Escola');
    }
    //return $this->belongsToMany(Escola::class, 'escola_users', 'user_id', 'escola_id');
    public function turmaAluno()
    {
        //1turma muitos aluno
        //return $this->hasMany('App\Models\Aluno');
        //return $this->hasMany(turma_Aluno::class, 'id', 'turma_id');
        //return $this->hasMany(Turma_Aluno::class, 'id_turma');
        return $this->belongsToMany(Aluno::class, 'turma_aluno', 'id_turma', 'id_aluno');
    }
    public function turmaChamada()
    {
        return $this->hasMany(Turma_Aluno::class, 'id_turma');
    }
}
