<?php

use App\Http\Controllers\DoencaController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;

//página home
Route::get('/', [HomeController::class, 'index']);
//pagina create doenca
Route::get('/escola/create', [EscolaController::class, 'create']);
//escola - create
Route::post('/escola', [EscolaController::class, 'store']);


//doencas - views
Route::get('/doenca/home', [DoencaController::class, 'index']);
//pagina create doenca
Route::get('/doenca/create', [DoencaController::class, 'create']);
//criar doencas - back-end
Route::post('/doenca', [DoencaController::class, 'store']);
//editar - tela
Route::get('doenca/edit/{id}', [DoencaController::class, 'edit']);
//bank-end salvar os dados no banco
Route::put('doenca/update/{id}', [DoencaController::class, 'update']);
//Deletar doenca
Route::delete('/doenca/{id}', [DoencaController::class, 'destroy']);

//question-perguntas - views
Route::get('/question/home', [QuestionController::class, 'index']);
//criar question-perguntas
Route::get('/question/create', [QuestionController::class, 'create']);
//salvar no banco - back-end
Route::post('/question', [QuestionController::class, 'store']);
//editar - tela - question
Route::get('question/edit/{id}', [QuestionController::class, 'edit']);
//bank-end salvar os dados no banco
Route::put('question/update/{id}', [QuestionController::class, 'update']);
//criar a delete de question
route::delete('question/{id}', [QuestionController::class, 'destroy']);

//Quiz
Route::get('/quiz/home', [QuizController::class, 'index']);
//criar um quiz
Route::get('/quiz/create', [QuizController::class, 'create']);
//rota de salve
Route::post('/quiz', [QuizController::class, 'store']);
//deletar quiz
route::delete('quiz/{id}', [QuizController::class, 'destroy']);

//Quiz x pergunta
Route::get('/quiz/vincular/{id}', [QuizController::class, 'createVinculo']);
Route::post('/quiz/vincular', [QuizController::class, 'createVinculoQuiz']);
