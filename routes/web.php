<?php

use App\Http\Controllers\DoencaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionController;

//página home
Route::get('/', [HomeController::class, 'index']);

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
