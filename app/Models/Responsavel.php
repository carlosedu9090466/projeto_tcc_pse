<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Responsavel extends Model
{
    use HasFactory;

    protected $table = 'responsavels';

    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];


    //alunos vinculados pelo CPF
    public static function AlunosVinculadosCpfResponsavel($cpf_responsavel)
    {
        $alunosVinculadosCpf = DB::table('alunos')
            ->join('responsavels', 'alunos.cpf_responsavel', '=', 'responsavels.cpf')
            ->join('turma_aluno', 'turma_aluno.id_aluno', '=', 'alunos.id')
            ->join('turmas', 'turmas.id', '=', 'alunos.id_turma_aluno')
            // ->join('turma_aluno', 'turma_aluno.id_turma', '=', 'alunos.id_turma_aluno')
            ->join('users', 'users.id', '=', 'responsavels.user_id')
            // ->where('turma_aluno.id_turma', '=', 'alunos.id_turma_aluno')
            ->where('turma_aluno.status_aluno_turma', '=', 'MATRICULADO')
            ->where('responsavels.cpf', '=', $cpf_responsavel)
            //ativa e não fechada
            ->where('turmas.status_turma', '=', 1)
            ->select('alunos.*', 'turma_aluno.status_aluno_turma', 'turmas.id as id_turma', 'turmas.serie', 'turmas.tipo_ensino', 'turmas.sala', 'turmas.turno', 'users.name as nomeReponsavel', 'responsavels.cpf')
            ->get();


        return $alunosVinculadosCpf;
    }
}
