<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Genero;
use App\Models\Quiz;
use App\Models\Quiz_Question;
use App\Models\Responde_Quiz;
use App\Models\Sexo;
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
        $generos = Genero::all();
        $sexos = Sexo::all();
        return view('aluno.create', ['escola' => $escola, 'generos' => $generos, 'sexos' => $sexos]);
    }

    public function edit($id)
    {
        $aluno = Aluno::findOrfail($id);
        $generos = Genero::all();
        $sexos = Sexo::all();

        return view('aluno.edit', ['aluno' => $aluno, 'generos' => $generos, 'sexos' => $sexos]);
    }

    public function update(Request $request)
    {

        $data = $request->all();

        Aluno::findOrFail($request->id)->update($data);

        return redirect('/alunos/visualiza/' . $request->inep)->with('msg', 'Aluno editado com sucesso!');;
    }

    //verificar essa questão do retorno do valor
    public function visulizaAluno($id)
    {
        $idescola = Session::get('escola_id');
        $escola = Escola::findOrfail($idescola);
        //$alunos = Aluno::where('inep', '=', $id)->get();

        $search = request('pesq');
        if ($search) {
            $alunos = Aluno::where(
                [['nome', 'like', '%' . $search . '%'],]
            )->orWhere(
                [
                    ['cpf_aluno', 'like', '%' . $search . '%']
                ]
            )->get();
        } else {
            $alunos = Aluno::where('inep', '=', $id)->get();
        }
        return view('aluno.visualiza', ['alunos' => $alunos, 'escola' => $escola]);
        //return view('/alunos/visualiza/' . $idescola, ['alunos' => $alunos, 'escola' => $escola]);
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
            'cpf_responsavel' => 'required',
            'dataNascimento' => 'required',
            'sexo' => 'required',
            'genero' => 'required',
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
        $aluno->genero = $request->genero;
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

            Aluno::where('id', '=', $aluno)->update(['id_turma_aluno' => $id_turma]);
        }

        return redirect('/turmas/home/' . $id)->with('msg', 'Alunos Associados na turma: ' . $turma->tipo_ensino . ' - ' . $turma->serie . ' - ' . $turma->turno . ' - ' . $turma->sala);
    }


    //deletar aluno da turma
    public function destroy(int $id_aluno, int $id_turma)
    {
        //User_Escolar::where('user_id', '=', $idUser)->where('escola_id', '=', $idEscola)->delete();
        $turma = Turma::where('id', '=', $id_turma)->where('status_turma', '=', 0)->first();
        if ($turma) {
            return redirect('/turmas/espelho/' . $id_turma)->with('msg', 'Não é possível excluir o aluno, pois a turma está fechada!');
        }
        //verificar se o o aluno possui resposta
        Turma_Aluno::where('id_aluno', '=', $id_aluno)->where('id_turma', '=', $id_turma)->delete();
        return redirect('/turmas/espelho/' . $id_turma)->with('msg', 'Aluno excluido da turma com sucesso!');
    }


    //Reponder Quiz

    public function createQuestionarios(Request $request)
    {
        $dado_aluno = $request->all();
        $dt = new DateTime();
        $now = $dt->format('Y-m-d');
        //dd($now);
        $quizs = Quiz::where('status_quiz', '=', 1)->where('date_fim_quiz', '>=', $now)->get();
        //dd($dado_aluno);
        //$quizs = Quiz::where('status_quiz', '=', 1)->where('date_fim_quiz', '>=', $now)->get();
        //$quiz = Quiz::with('QuizVinculoQuestion')->get();
        //$quizs = Quiz_Question::quizQuestionario($quiz);

        //return view('responderQuiz.create', ['quizs' => $quizs, 'dado_aluno' => $dado_aluno]);
        return view('responderQuiz.questionariosAbertos', ['quizs' => $quizs, 'dado_aluno' => $dado_aluno]);
    }

    public function createResponde(Request $request)
    {
        /*VERIFICAR A QUESTÃO DA DATA SE ESTÁ OK PARA RESPONDER*/

        $quizs = Quiz_Question::quizQuestionario($request->id_quiz);
        $dado_aluno = $request->all();

        return view('responderQuiz.create', ['quizs' => $quizs, 'dado_aluno' => $dado_aluno]);
    }



    public function storeResposta(Request $request)
    {

        $dt = new DateTime();
        $data_resposta = $dt->format('Y-m-d');

        $quiz_question = $request->id_quiz_question;
        $resposta = $request->resposta;


        //$verificaRespostaQuiz = Responde_Quiz::where('id_aluno', '=', $request->id_aluno)->where('id_turma', '=', $request->id_turma)->first();
        //dd($verificaRespostaQuiz);
        $verificaRespostaQuiz = Responde_Quiz::verificaQuizRespondido($request->id_quiz, $request->id_turma, $request->id_aluno);

        if ($verificaRespostaQuiz > 0) {
            return redirect('responsavel/home')->with('msg', 'Não é possível responder esse questionário, pois foi respondido!');
        }

        foreach ($quiz_question as $q) {
            $responde_quiz = new Responde_Quiz;
            $responde_quiz->id_aluno = $request->id_aluno;
            $responde_quiz->id_turma = $request->id_turma;
            $responde_quiz->id_quiz_question = $q;
            $responde_quiz->resposta_question = $resposta[$q];
            $responde_quiz->data_resposta = $data_resposta;
            $responde_quiz->save();
        }

        return redirect('responsavel/home')->with('msg', 'Questionario respondido com sucesso!');
    }
}
