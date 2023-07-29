<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Turma;
use Illuminate\Http\Request;

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
        if (!$turmas) {
            return redirect('/turmas/home/' . $id)->with('msg', 'Não há turmas criadas nesse periodo!');
        }

        return view('aluno.vinculoTurma', ['escola' => $escola, 'turmas' => $turmas]);
    }
}
