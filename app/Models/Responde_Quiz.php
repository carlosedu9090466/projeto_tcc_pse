<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Responde_Quiz extends Model
{
    use HasFactory;
    //responde_quiz
    protected $table = 'responde_quiz';

    protected $dates = ['date'];
    //deixa atulizar tudo
    protected $guarded = [];



    public static function respostasAlunos(int $id_quiz)
    {

        $quiz = DB::table('quiz_question')
            ->join('responde_quiz', 'responde_quiz.id_quiz_question', '=', 'quiz_question.id')
            ->where('quiz_question.quiz_id', '=', $id_quiz)
            ->select('responde_quiz.id_aluno as id_aluno')
            ->get();

        return $quiz;
    }

    public static function verificaQuizRespondido(int $id_quiz, int $id_turma, int $id_aluno){

        $verificarQuiz = DB::table('quiz_question')
                        ->join('responde_quiz', 'responde_quiz.id_quiz_question', '=', 'quiz_question.id')
                        ->where('quiz_question.quiz_id', '=', $id_quiz)
                        ->where('responde_quiz.id_aluno', '=', $id_aluno)
                        ->where('responde_quiz.id_turma', '=',$id_turma)
                        ->count();

        return $verificarQuiz;

    }

}
