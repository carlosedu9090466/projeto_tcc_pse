<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma_Aluno extends Model
{
    use HasFactory;

    protected $table = 'turma_aluno';
    protected $dates = ['date'];
    protected $fillable = ['id_aluno', 'id_turma', 'status_aluno_turma', 'n_chamada', 'dt_matricula'];

    protected $guarded = [];
}
