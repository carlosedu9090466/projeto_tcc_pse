<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Escola;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgenteController extends Controller
{

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
        $roles = Role::where('id', '=', 3)->get();
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
        return view('agente.home');
    }

    public function homeAgente()
    {
        //$agentes = Agente::all();
        $agentes = User::AgenteInformacoes(3);
        //dd($agentes);
        return view('agente.createVinculo', ['agentes' => $agentes]);
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
        dd($agente);
        $escolas = Escola::all();

        return view('agente.vincularEscola', ['agente' => $agente, 'escolas' => $escolas]);
    }
}
