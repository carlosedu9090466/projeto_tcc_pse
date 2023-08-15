<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Responde_Quiz;
use App\Models\Sala;
use App\Models\Serie;
use App\Models\Turma;
use App\Models\Turma_Aluno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TurmaController extends Controller
{
    public function index($id)
    {
        //trazer o relacionamento com as escolas nessa view
        // $question = Question::with('doencas')->findOrFail($id);
        $escola = Escola::findOrFail($id);
        //$user = User::with('UserEscolarVinculo')->findOrFail($id_user);
        //$turmas = Escola::with('EscolaMuitasTurmas')->findOrFail($escola->id);
        // Quiz_Question::where('quiz_id', $id)->delete();
        $turmas = Turma::with('turmaAluno')->where('escola_id', $escola->id)->get();
        //dd($turmas);
        //dd(Auth::guard()->user());
        //pega o id da escola
        //dd(Session::get('escola_id'));

        return view('turma.home', ['escola' => $escola, 'turmas' => $turmas]);
    }

    public function create($id)
    {
        $escola = Escola::findOrFail($id);
        $series = Serie::all();
        $salas = Sala::all();
        return view('turma.create', ['escola' => $escola, 'series' => $series, 'salas' => $salas]);
    }


    public function store(Request $request)
    {
        $regras = [
            'tipo_ensino' => 'required',
            'serie' => 'required',
            'turno' => 'required',
            'sala' => 'required',
            'vigencia_inicial' => 'required',
            'vigencia_final' => 'required',
            'status_turma' => 'required',
            'escola_id' => 'exists:escolas,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'escola_id.exists' => 'A escola informada não existe'
        ];

        $request->validate($regras, $feedback);
        $turma = new Turma;

        $turma->escola_id = $request->escola_id;
        $turma->serie = $request->serie;
        $turma->turno = $request->turno;
        $turma->tipo_ensino = $request->tipo_ensino;
        $turma->sala = $request->sala;
        $turma->vigencia_inicial = $request->vigencia_inicial;
        $turma->vigencia_final = $request->vigencia_final;
        $turma->status_turma = $request->status_turma;

        $turma->save();

        //$escola = Escola::findOrFail($request->escola_id);

        //$turmas = Turma::where('escola_id', $escola->id)->get();
        return redirect('/turmas/home/' . $request->escola_id)->with('msg', 'turma cadastrada com sucesso!');
    }

    public function espelhoTurma($id_turma)
    {
        $id_escola = Session::get('escola_id');
        $escola = Escola::findOrFail($id_escola);
        $turma = Turma::with('turmaAluno')->with('turmaChamada')->findOrFail($id_turma);
        //$turmaAluno = Turma::with(['turmaAluno', 'turmaChamada'])->where('escola_id', '=', $id)->get();

        return view('turma.espelhoturma', ['turma' => $turma, 'escola' => $escola]);
    }

    //turmas abertas view
    public function turmasAbertas()
    {
        $id_escola = Session::get('escola_id');
        //turmas abertas
        $turmasAbertas = Turma::where('escola_id', '=', $id_escola)->get();
        //dd($turmasAbertas);
        return view('turma.fecharTurma', ['turmasAbertas' => $turmasAbertas]);
    }

    public function fecharTurma(Request $request)
    {
        $id_escola = Session::get('escola_id');

        $fechamento = Turma::findOrfail($request->id_turma)->update(['status_turma' => $request->status]);

        if ($fechamento) {
            Aluno::where('id_turma_aluno', '=', $request->id_turma)->update(['id_turma_aluno' => null]);
        }

        return redirect('/turmas/fecharTurma/' . $id_escola)->with('msg', 'Turma fechada com sucesso!');
    }



    //excluir turma. só é possível excluindo os alunos!
    public function destroy($id)
    {
        $id_escola = Session::get('escola_id');
        $existeRespostaAluno = Responde_Quiz::where('id_turma', '=', $id)->count();
        $existeAlunoTurma = Turma_Aluno::where('id_turma', '=', $id)->count();

        if ($existeRespostaAluno) {
            return redirect('/turmas/home/' . $id_escola)->with('msg', 'Não é possível a operação. Há respostas de questionário!');
        }

        if ($existeAlunoTurma) {
            return redirect('/turmas/home/' . $id_escola)->with('msg', 'Não é possível a operação. Há alunos na turma!');
        }
        Turma::findOrfail($id)->delete();
        return redirect('/turmas/home/' . $id_escola)->with('msg', 'Turma excluida com sucesso!');
    }
}
