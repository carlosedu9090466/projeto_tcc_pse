<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz_Question extends Model
{
    use HasFactory;

    // 520 741 8
    // model refereciando a table de Question e Quiz.
    //N para N
    protected $table = 'quiz_question';


    public static function quizQuestionario(int $ids)
    {

        $quiz = DB::table('quizs')
            ->join('quiz_question', 'quiz_question.quiz_id', '=', 'quizs.id')
            ->join('questions', 'questions.id', '=', 'quiz_question.question_id')
            ->join('doencas', 'doencas.id', '=', 'questions.doenca_id')
            ->leftJoin('responde_quiz', 'responde_quiz.id_quiz_question', '=', 'quiz_question.id')
            ->where('quizs.status_quiz', '=', 1)
            ->where('quizs.id', $ids)
            ->select('quiz_question.id as id_quiz_question', 'questions.id as id_question', 'questions.pergunta','responde_quiz.resposta_question' ,'quizs.id as id_quiz', 'quizs.nome_quiz', 'quizs.date_inicio_quiz', 'quizs.date_fim_quiz', 'doencas.nome', 'doencas.sintomas')
            ->get();

        return $quiz;
    }
}
