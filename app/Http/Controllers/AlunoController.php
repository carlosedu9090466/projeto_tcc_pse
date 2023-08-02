<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Turma;
use App\Models\Turma_Aluno;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    public function create($id)
    {
        $escola = Escola::findOrfail($id);

        return view('aluno.create', ['escola' => $escola]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required',
            'nome_pai' => 'required',
            'nome_mae' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'cpf_aluno' => 'required|unique:alunos',
            'cpf_responsavel' => 'required|unique:alunos',
            'dataNascimento' => 'required',
            'sexo' => 'required',
            //'escola_id' => 'exists:escolas,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'unique' => 'CPF já cadastrado'
            //'escola_id.exists' => 'A escola informada não existe'
        ];
        $request->validate($regras, $feedback);
        $aluno = new Aluno;

        $aluno->nome = $request->nome;
        $aluno->nome_pai = $request->nome_pai;
        $aluno->nome_mae = $request->nome_mae;
        $aluno->rua = $request->rua;
        $aluno->bairro = $request->bairro;
        $aluno->numero = $request->numero;
        $aluno->cpf_aluno = $request->cpf_aluno;
        $aluno->cpf_responsavel = $request->cpf_responsavel;
        $aluno->dataNascimento = $request->dataNascimento;
        $aluno->sexo = $request->sexo;
        $aluno->inep = $request->escola_id;

        $aluno->save();

        return redirect('/turmas/home/' . $request->escola_id)->with('msg', 'Aluno matriculado com sucesso!');
    }

    public function createVinculoAluno($id)
    {
        //trazer as turmas desssa escola e os alunos também!
        $escola = Escola::findOrfail($id);
        $turmas = Turma::where('escola_id', $id)->where('status_turma', 1)->get();
        $alunos = Aluno::where('inep', $id)->whereNull('id_turma_aluno')->get();

        if (!$turmas) {
            return redirect('/turmas/home/' . $id)->with('msg', 'Não há turmas criadas nesse periodo!');
        }

        if (!$alunos) {
            return redirect('/turmas/home/' . $id)->with('msg', 'Não há alunos matriculados nessa escola ou todos estão associados nas suas turmas!');
        }

        return view('aluno.vinculoTurma', ['escola' => $escola, 'turmas' => $turmas, 'alunos' => $alunos]);
    }

    public function associarAlunoStore(Request $request)
    {
        //escola
        $id = Session::get('escola_id');
        $aluno = $request->id_aluno;
        if (!$aluno) {
            return redirect('/alunos/vinculo/' . $id)->with('msg', 'Nenhum Aluno selecionado!');
        }

        $id_turma = $request->id_turma;
        $turma = Turma::find($id_turma);
        $status = 'MATRICULADO';
        //Ano de criação da turma
        //$ano_turma = date('Y', strtotime($turma->vigencia_inicial));
        //dd($turma);
        $dt = new DateTime();
        $now = $dt->format('Y-m-d');
        //$now = Carbon::now()->format('d-m-Y');


        foreach ($request->id_aluno as $aluno) {
            $turmaAluno = new Turma_Aluno;
            $turmaAluno->id_aluno = $aluno;
            $turmaAluno->id_turma = $id_turma;
            $turmaAluno->status_aluno_turma = $status;
            $turmaAluno->dt_matricula = $now;
            $turmaAluno->save();
        }

        return redirect('/turmas/home/' . $id)->with('msg', 'Alunos Associados na turma: ' . $turma->tipo_ensino . ' - ' . $turma->serie . ' - ' . $turma->turno . ' - ' . $turma->sala);
    }
}
