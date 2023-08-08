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


    public static function quizQuestionario($ids)
    {
        $quiz = DB::table('quizs')
            ->join('quiz_question', 'quiz_question.quiz_id', '=', 'quizs.id')
            ->join('questions', 'questions.id', '=', 'quiz_question.question_id')
            ->join('doencas', 'doencas.id', '=', 'questions.doenca_id')
            ->where('quizs.status_quiz', '=', 1)
            ->whereIn('quizs.id', $ids)
            ->select('questions.pergunta', 'quizs.id as id_quiz', 'quizs.nome_quiz', 'quizs.date_inicio_quiz', 'quizs.date_fim_quiz', 'doencas.nome', 'doencas.sintomas')
            ->get();

        return $quiz;
    }
}
