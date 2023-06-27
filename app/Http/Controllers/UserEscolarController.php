<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\User_Escolar;
use App\Models\UserEscolar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserEscolarController extends Controller
{
    //home doencas - page
    public function index()
    {
        $escolas = Escola::all();
        $userEscolar = UserEscolar::all();

        return view('userEscolar.home', ['userEscolar' => $userEscolar, 'escolas' => $escolas]);
    }

    public function create()
    {
        return view('userEscolar.create');
    }

    public function store(Request $request)
    {

        $userEscolar = new UserEscolar;

        $regras = [
            'nome' => 'required|min:3|max:100',
            'cpf' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
        ];

        $request->validate($regras, $feedback);

        $userEscolar->nome = $request->nome;
        $userEscolar->cpf = $request->cpf;
        $userEscolar->telefone = $request->telefone;
        $userEscolar->email = $request->email;
        $userEscolar->sexo = $request->sexo;
        $userEscolar->data_nascimento = $request->data_nascimento;
        $userEscolar->save();

        return redirect('/userEscolar/home')->with('msg', 'Usuário cadastrado com sucesso!');
    }

    public function createUserEscolar($id)
    {
        //$question = Question::with('doencas')->findOrFail($id);
        $userEscolar = UserEscolar::findOrfail($id);
        $escolas = Escola::all();
        $UserEscolaVinculos = UserEscolar::with('UserEscolarVinculo')->findOrFail($id);
        return view('userEscolar.createVinculoEscola', ['userEscolar' => $userEscolar, 'escolas' => $escolas, 'UserEscolaVinculos' => $UserEscolaVinculos]);
    }

    public function createVinculo(Request $request)
    {

        //dd($request);

        //verifica se possui vinculo com a escola selecionada para salvar!
        $existeVinculo = User_Escolar::where('escola_id', '=', $request->escola_id)->where('user_id', '=', $request->userEscolar)->first();
        if ($existeVinculo) {
            return redirect('/userEscolar/vincularEscola/' . $request->userEscolar)->with('msg', 'Usuário já possui vinculado com essa escola!');
        }
        $vinculoUserEscolar = new User_Escolar;
        $vinculoUserEscolar->user_id = $request->userEscolar;
        $vinculoUserEscolar->escola_id = $request->escola_id;
        $vinculoUserEscolar->status_user_escolar = $request->userAtivo;
        $vinculoUserEscolar->save();

        //return redirect('/userEscolar/home')->with('msg', 'Vinculo Estabelecido com sucesso!');
        return redirect('/userEscolar/vincularEscola/' . $request->userEscolar)->with('msg', 'Vinculo Estabelecido com sucesso!');
    }
}
