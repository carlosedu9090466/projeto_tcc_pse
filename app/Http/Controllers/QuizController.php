<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizs = Quiz::all();
        $questions = Question::with('doencas')->get();

        return view('quiz.home', ['quizs' => $quizs, 'questions' => $questions]);
    }

    public function create()
    {

        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome_quiz' => 'required|min:5|max:100',
            'date_inicio_quiz' => 'required',
            'date_fim_quiz' => 'required',
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'nome_quiz.min' => 'A Questionário deve ter no mínino 5 caracteres',
            'nome_quiz.max' => 'A Questionário deve ter no máximo 100 caracteres',
        ];
        $request->validate($regras, $feedback);

        $quiz = new Quiz;

        $quiz->nome_quiz = $request->nome_quiz;
        $quiz->date_inicio_quiz = $request->date_inicio_quiz;
        $quiz->date_fim_quiz = $request->date_fim_quiz;
        $quiz->status_quiz = $request->status_quiz;
        // salvando no banco os dados vindo do form através do request
        $quiz->save();

        return redirect('/quiz/home')->with('msg', 'questionario cadastrado com sucesso!');
    }



    public function createVinculo($id)
    {

        $quiz = Quiz::findOrFail($id);

        if (!$quiz) {
            return redirect('/quiz/home')->with('msg', 'questionario Não encontrado!');
        }
        $questions = Question::with('doencas')->get();

        return view('quiz.createVinculo', ['questions' => $questions, 'quiz' => $quiz]);
    }

    public function createVinculoQuiz(Request $request)
    {
        dd($request);
    }
}
