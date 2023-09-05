<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use App\Models\Agente;
use App\Models\Agente_Escola;
use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Role;
use App\Models\Turma;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    public function create()
    {
        $roles = Role::whereIn('id', [3, 2])->get();
        return view('agente.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        //criando agente
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/')->with('msg', 'Agente cadastrado com sucesso!');
    }


    public function index()
    {
        $agente_id = auth()->user()->id;
        $escolasVinculadasAgente = Agente::agenteVinculoEscolas($agente_id);
        //dd($escolasVinculadasAgente);
        return view('agente.home', ['escolasVinculadasAgente' => $escolasVinculadasAgente]);
    }

    public function homeAgente()
    {
        //$agentes = Agente::all();
        $agentes = User::AgenteInformacoes(3);
        //dd($agentes);
        return view('agente.createVinculo', ['agentes' => $agentes]);
    }

    public function escolasTurmasAgente($id_escola)
    {

        $turmas = Turma::where('escola_id', '=', $id_escola)->where('status_turma', 1)->get();

        return view('agente.turmasEscolasAgente', ['turmas' => $turmas]);
    }

    public function visualizarAlunosTurma($id_turma)
    {
        //query alunos turma
        $alunos = Agente::visualizarAlunosTurma($id_turma);
        //dd($alunos);
        return view('agente.visualizarAlunosTurma', ['alunos' => $alunos]);
    }

    public function visualizaQuizAluno(int $id_aluno, int $id_turma)
    {

        $alunoResposta = Agente::alunoQuestionario($id_aluno, $id_turma);
        if ($alunoResposta->count() == 0) {
            dd('aqui');
        }
        $aluno = Aluno::findOrfail($id_aluno);
        $agente_id = auth()->user()->id;
        $agente = Agente::where('user_id', $agente_id)->get();
        $turma = Turma::findOrfail($id_turma);
        $observacao = Acompanhamento::where('id_aluno', $id_aluno)->where('id_turma', $id_turma)->get();

        return view('agente.visualizaRespostaAluno', ['alunoResposta' => $alunoResposta, 'aluno' => $aluno, 'agente' => $agente[0], 'turma' => $turma, 'observacao' => $observacao]);
    }


    public function createDados()
    {

        $agente_id = auth()->user()->id;

        $agente = Agente::where('user_id', $agente_id)->count();

        if ($agente == 0) {
            return view('agente.createDados');
        }

        $agente = Agente::where('user_id', $agente_id)->get();

        return view('agente.dadosAtualiza', ['agente' => $agente[0]]);
    }

    public function storeDados(Request $request)
    {
        $agente_id = auth()->user()->id;

        $regras = [
            'cpf' => 'required|unique:agentes',
            'dataNascimento' => 'required',
            'sexo' => 'required',
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'unique' => 'CPF já cadastrado'
        ];
        $request->validate($regras, $feedback);


        $agente = new Agente;

        $agente->cpf = $request->cpf;
        $agente->codigo_agente = $request->codigo_agente;
        $agente->sexo = $request->sexo;
        $agente->dataNascimento = $request->dataNascimento;
        $agente->user_id = $agente_id;

        $agente->save();


        return redirect('/agente/agenteHome')->with('msg', 'Dados Inseridos com sucesso!');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        Agente::findOrFail($request->id)->update($data);

        return redirect('/agente/agenteHome')->with('msg', 'Dados Atualizados com sucesso!');
    }

    //vincular escolas e agente
    public function createAgenteEscolar($id)
    {
        $agente = Agente::AgenteInformacoes($id);

        $escolas = Escola::all();
        $agentesVinculados = Agente::with('UserAgenteVinculo')->where('id', '=', $id)->get();
        //dd($agentesVinculados[0]);
        return view('agente.vincularEscola', ['agente' => $agente, 'escolas' => $escolas, 'agentesVinculados' => $agentesVinculados[0]]);
    }

    public function storeVinculoEscolar(Request $request)
    {
        //dd($request);
        $existeVinculo = Agente_Escola::where('escola_id', '=', $request->escola_id)->where('agente_id', '=', $request->agenteEscolar)->first();
        if ($existeVinculo) {
            return redirect('/agente/vincularEscola/' . $request->agenteEscolar)->with('msg', 'Usuário já possui vinculado com essa escola!');
        }

        $dt = new DateTime();
        $now = $dt->format('Y-m-d');

        $vinculoUserAgente = new Agente_Escola;

        $vinculoUserAgente->agente_id = $request->agenteEscolar;
        $vinculoUserAgente->escola_id = $request->escola_id;
        $vinculoUserAgente->status_agente_escola = $request->agenteAtivo;
        $vinculoUserAgente->dia_lotado = $now;
        $vinculoUserAgente->save();

        return redirect('/agente/vincularEscola/' . $request->agenteEscolar)->with('msg', 'Agente vinculado a Escola!');
    }

    public function deletecreate(int $idAgente, int $idEscola)
    {

        Agente_Escola::where('agente_id', '=', $idAgente)->where('escola_id', '=', $idEscola)->delete();
        return redirect('/agente/vincularEscola/' . $idAgente)->with('msg', 'Vinculo excluido com sucesso!');
    }
}
