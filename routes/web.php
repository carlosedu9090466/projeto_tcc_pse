<?php

use App\Http\Controllers\AcompanhamentoController;
use App\Http\Controllers\AgenteController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DoencaController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImcController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserEscolarController;
use App\Models\Responsavel;
use Illuminate\Support\Facades\Auth;

//página home
Route::get('/', [HomeController::class, 'index']);
//pagina create doenca
Route::get('/escola/create', [EscolaController::class, 'create']);
//escola - create
Route::post('/escola', [EscolaController::class, 'store']);
Route::delete('/escola/{id}', [EscolaController::class, 'destroy']);
Route::get('/escola/home', [EscolaController::class, 'index']);

//Turmas - UserEscolar - views - acessando a escola com o user
Route::get('/turmas/home/{id}', [TurmaController::class, 'index']);
Route::get('/turmas/create/{id}', [TurmaController::class, 'create']);
Route::post('/turmas', [TurmaController::class, 'store']);
Route::get('/turmas/espelho/{id}', [TurmaController::class, 'espelhoTurma']);
Route::get('/turmas/fecharTurma/{id}', [TurmaController::class, 'turmasAbertas']);
Route::put('/turmas/fechar/{id}', [TurmaController::class, 'fecharTurma']);
Route::delete('/turmas/{id}', [TurmaController::class, 'destroy']);
//End

//Alunos - routes - id é a escola
Route::get('/alunos/create/{id}', [AlunoController::class, 'create']);
Route::post('/alunos', [AlunoController::class, 'store']);
//tela de associacao aluno x turma
Route::get('/alunos/vinculo/{id}', [AlunoController::class, 'createVinculoAluno']);
Route::post('/associarAluno', [AlunoController::class, 'associarAlunoStore']);
Route::delete('/alunos/{idAluno}&{idTurma}', [AlunoController::class, 'destroy']);
Route::get('/alunos/visualiza/{id}', [AlunoController::class, 'visulizaAluno']);
//END

//RESPONSAVEIS
Route::get('/responsavel/home', [ResponsavelController::class, 'index']);
Route::get('/responsavel/create', [ResponsavelController::class, 'create']);
Route::post('/responsavel', [ResponsavelController::class, 'store']);
Route::put('/responsavel/update/{id}', [ResponsavelController::class, 'update']);
Route::get('/adm/visulizaResponsaveis', [ResponsavelController::class, 'indexTodos']);
//END

//Responder_quiz
Route::post('/responsavel/responderQuiz/create', [AlunoController::class, 'createQuestionarios']);
Route::post('responsavel/responderQuiz', [AlunoController::class, 'createResponde']);
Route::post('/respostaQuiz', [AlunoController::class, 'storeResposta']);


//User Escolar - criacao, vinculos Escolas
Route::get('/userEscolar/homeUser', [UserEscolarController::class, 'homeUser']);
Route::get('/userEscolar/home', [UserEscolarController::class, 'index']);
Route::get('/userEscolar/create', [UserEscolarController::class, 'create']);
//PUT
Route::put('/userEscolar/update/{id}', [UserEscolarController::class, 'update']);
Route::post('/userEscolar', [UserEscolarController::class, 'store']);
Route::get('/userEscolar/vincularEscola/{id}', [UserEscolarController::class, 'createUserEscolar']);
Route::post('/userEscolar/vinculo', [UserEscolarController::class, 'createVinculo']);
Route::delete('/userEscolar/deletar/{idUser}&{idEscola}', [UserEscolarController::class, 'deletecreate']);
Route::delete('/userEscolar/deletar/{id}', [UserEscolarController::class, 'deleteUserEscolar']);
//End

//AGENTE DE SAÚDE
Route::get('/agente/agenteHome', [AgenteController::class, 'index']);
Route::get('/agente/home', [AgenteController::class, 'homeAgente']);
Route::get('/agente/create', [AgenteController::class, 'create']);
Route::post('/agente', [AgenteController::class, 'store']);
Route::get('/agente/createVinculo', [AgenteController::class, 'homeAgente']);
Route::get('/agente/dados', [AgenteController::class, 'createDados']);
Route::post('/agenteDados', [AgenteController::class, 'storeDados']);
Route::put('/agente/update/{id}', [AgenteController::class, 'update']);
Route::get('/agente/vincularEscola/{id}', [AgenteController::class, 'createAgenteEscolar']);
Route::post('/agenteEscolar/vinculo', [AgenteController::class, 'storeVinculoEscolar']);
Route::get('/agente/turmas/{id}', [AgenteController::class, 'escolasTurmasAgente']);
Route::get('/agente/visualizarAlunos/{id}', [AgenteController::class, 'visualizarAlunosTurma']);
Route::get('/agente/acompanhamento/{idAluno}&{idTurma}', [AgenteController::class, 'visualizaQuizAluno']);
Route::delete('/agenteEscolar/deletar/{idAgente}&{idEscola}', [AgenteController::class, 'deletecreate']);
Route::delete('/agente/deletar/{id}&{idU}', [AgenteController::class, 'deleteUserAgente']);
//END

//ACOMPANHAMENTO
Route::post('/acompanhamento', [AcompanhamentoController::class, 'storeAcompanhamento']);
//END

//IMC CADASTRO
Route::post('/imc', [ImcController::class, 'store']);


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
Route::get('/doenca/deletar/{id}', [DoencaController::class, 'deletecreate']);
Route::delete('/doenca/{id}', [DoencaController::class, 'destroy']);
//END VIEWS doencas


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
//edit
Route::get('/quiz/edit/{id}', [QuizController::class, 'edit']);
//salvando...
Route::put('/quiz/update/{id}', [QuizController::class, 'update']);
//rota de salve
Route::post('/quiz', [QuizController::class, 'store']);
//delete
route::get('/quiz/delete/{id}', [QuizController::class, 'delete']);
//deletar quiz
route::delete('quiz/{id}&{id_repostas}', [QuizController::class, 'destroy']);

//Quiz x pergunta
Route::get('/quiz/vincular/{id}', [QuizController::class, 'createVinculo']);
Route::post('/quiz/vincular', [QuizController::class, 'createVinculoQuiz']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
