<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Quiz_Question;
use App\Models\Responde_Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        //dd($quiz);
        return view('quiz.edit', ['quiz' => $quiz]);
    }

    public function update(Request $request)
    {

        $data = $request->all();

        Quiz::findOrFail($request->id)->update($data);

        return redirect('/quiz/home')->with('msg', 'Dados editados com sucesso!');
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

        $quiz_question = Quiz_Question::where('quiz_id', '=', $quiz->id)->get()->pluck('question_id')->toArray();
        //dd($quiz_question);
        if (isset($quiz_question) && !empty($quiz_question)) {
            $result = implode(',', $quiz_question);
            $quest_dados_id = explode(',', $result);

            $questions = Question::with('doencas')->whereNotIn('id', $quest_dados_id)->get();

            if ($questions->count() == 0) {
                return redirect('/quiz/home')->with('msg', 'Não há perguntas para adicionar nesse questionário. crie mais perguntas!');
            }
        } else {
            $questions = Question::with('doencas')->get();
        }
        //dd($questions);
        return view('quiz.createVinculo', ['questions' => $questions, 'quiz' => $quiz]);
    }

    public function createVinculoQuiz(Request $request)
    {


        $quiz = $request->quiz_id;

        foreach ($request->question as $quest) {
            $vinculo = new Quiz_Question;
            $vinculo->quiz_id = $quiz;
            $vinculo->question_id = $quest;
            $vinculo->save();
        }

        return redirect('/quiz/home')->with('msg', 'perguntas inserida com sucesso!');
    }

    public function delete($id)
    {
        /*buscar os dados relacionados ao quiz e mostrar para o usuário antes de deletar*/
        $quiz = Quiz::findOrfail($id);

        //numeros de QUESTIONS relacionadas vinculadas ao QUIZ
        $quiz_question = Quiz_Question::where('quiz_id', '=', $id)->count();
        //dd($quiz_question);
        //agora deu certo
        $respostas_alunos = Responde_Quiz::respostasAlunos($id)->unique()->count();

        return view('quiz.delete', ['quiz' => $quiz, 'quiz_question' => $quiz_question, 'respostas_alunos' => $respostas_alunos]);
    }


    public function destroy($id, $alunosCount)
    {

        if ($alunosCount > 0) {
            $ids_quiz_question = Quiz_Question::where('quiz_id', '=', $id)->pluck('id');
            //deletar na table responde_question
            foreach ($ids_quiz_question as $quiz_question) {
                Responde_Quiz::where('id_quiz_question', '=', $quiz_question)->delete();
            }
        }
        //deletar as questions referente a doenca
        Quiz_Question::where('quiz_id', $id)->delete();
        Quiz::findOrFail($id)->delete();

        return redirect('/quiz/home')->with('msg', 'Dado excluido com sucesso!');
    }
}
