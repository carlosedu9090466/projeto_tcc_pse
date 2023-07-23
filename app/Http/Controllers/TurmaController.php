<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $turmas = Turma::where('escola_id', $escola->id)->get();


        return view('turma.home', ['escola' => $escola, 'turmas' => $turmas]);
    }
}
