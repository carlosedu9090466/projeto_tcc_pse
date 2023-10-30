<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use App\Models\Agente;
use App\Models\Agente_Escola;
use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Genero;
use App\Models\Imc;
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

        return redirect('/agente/create')->with('msg', 'Usuário cadastrado com sucesso!');
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
        //$agentes = User::AgenteInformacoes(3);
        $search = request('search');
        //$userAgente = User::where('role_id', '=', 3)->get();

        if ($search) {
            $userAgente = User::where('role_id','=',3)->where(
                [
                    ['name', 'like', '%' . $search . '%'],
                ]
            )->orWhere(
                [
                    ['email', 'like', '%' . $search . '%']
                ]
            )->get();
        } else {
            //pegar todos os eventos(dados) do banco
            $userAgente = User::where('role_id', '=', 3)->get();
        }

      
        //return view('agente.createVinculo', ['agentes' => $agentes]);
        return view('agente.createVinculo', ['userAgente' => $userAgente, 'search' => $search]);
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
        $imc = Imc::where('id_aluno', $id_aluno)->get();

        return view('agente.visualizaRespostaAluno', ['alunoResposta' => $alunoResposta, 'aluno' => $aluno, 'agente' => $agente[0], 'turma' => $turma, 'observacao' => $observacao, 'imc' => $imc]);
    }


    public function createDados()
    {

        $agente_id = auth()->user()->id;

        $agente = Agente::where('user_id', $agente_id)->count();
        $generos = Genero::all();
        if ($agente == 0) {
            return view('agente.createDados', ['generos' => $generos]);
        }

        $agente = Agente::where('user_id', $agente_id)->get();
    
        return view('agente.dadosAtualiza', ['agente' => $agente[0], 'generos' => $generos]);
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
        
        $dado_agente = Agente::where('user_id','=',$id)->first();
        
        if(is_null($dado_agente)){
            return redirect('/agente/createVinculo')->with('msg', 'É preciso o agente completar os dados para a possível vinculação!');
        }
        
        $agente = Agente::AgenteInformacoes($dado_agente->id);
       
        $escolas = Escola::all();
        $agentesVinculados = Agente::with('UserAgenteVinculo')->where('id', '=', $dado_agente->id)->get();
        
        return view('agente.vincularEscola', ['agente' => $agente, 'escolas' => $escolas, 'agentesVinculados' => $agentesVinculados[0]]);
    }

    public function storeVinculoEscolar(Request $request)
    {
       
        $existeVinculo = Agente_Escola::where('escola_id', '=', $request->escola_id)->where('agente_id', '=', $request->agenteEscolar)->first();
        if ($existeVinculo) {
            return redirect('/agente/vincularEscola/' . $request->UserAgenteID)->with('msg', 'Usuário já possui vinculado com essa escola!');
        }

        $dt = new DateTime();
        $now = $dt->format('Y-m-d');

        $vinculoUserAgente = new Agente_Escola;

        $vinculoUserAgente->agente_id = $request->agenteEscolar;
        $vinculoUserAgente->escola_id = $request->escola_id;
        $vinculoUserAgente->status_agente_escola = $request->agenteAtivo;
        $vinculoUserAgente->dia_lotado = $now;
        $vinculoUserAgente->save();

        return redirect('/agente/vincularEscola/' . $request->UserAgenteID)->with('msg', 'Agente vinculado a Escola!');
    }

    public function deletecreate(int $idAgente, int $idEscola)
    {

        Agente_Escola::where('agente_id', '=', $idAgente)->where('escola_id', '=', $idEscola)->delete();
        return redirect('/agente/vincularEscola/' . $idAgente)->with('msg', 'Vinculo excluido com sucesso!');
    }
    public function deleteUserAgente(int $idUserAgente)
    {
        $idAgente = Agente::where('user_id','=',$idUserAgente)->first();

        if($idAgente && $idAgente != null){
            $vinculoAgenteEscola = Agente_Escola::where('agente_id', '=', $idAgente)->first();
        $acompanhamento = Acompanhamento::where('id_agente', '=', $idAgente)->select('id_aluno')->distinct()->get()->count();
        if ($acompanhamento && $acompanhamento != null) {
            return redirect('/agente/createVinculo')->with('msg', 'Não é possível deletar, pois o agente possui dados de acompanhamento!');
        } else if ($vinculoAgenteEscola && $vinculoAgenteEscola != null) {
            return redirect('/agente/createVinculo')->with('msg', 'Não é possível deletar, pois o agente possui vinculo com escolas!');
        } else {
            Agente::where('user_id', $idAgente)->delete();
            User::where('id', $idUserAgente)->delete();

            return redirect('/agente/createVinculo')->with('msg', 'Agente Saúde deletado com sucesso!');
        }
        }else{
            User::where('id', $idUserAgente)->delete();
            return redirect('/agente/createVinculo')->with('msg', 'Agente Saúde deletado com sucesso!');
        }

      
    }
}
