<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\User_Escolar;
use App\Models\UserEscolar;
use Illuminate\Http\Request;

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

        $userEscolar = UserEscolar::findOrfail($id);
        $escolas = Escola::all();

        return view('userEscolar.createVinculoEscola', ['userEscolar' => $userEscolar, 'escolas' => $escolas]);
    }

    public function createVinculo(Request $request)
    {

        //dd($request);
        $vinculoUserEscolar = new User_Escolar;

        $vinculoUserEscolar->user_id = $request->userEscolar;
        $vinculoUserEscolar->escola_id = $request->escola_id;
        $vinculoUserEscolar->status_user_escolar = $request->userAtivo;
        $vinculoUserEscolar->save();

        //return redirect('/userEscolar/home')->with('msg', 'Vinculo Estabelecido com sucesso!');
        return redirect('/userEscolar/vincularEscola/' . $request->userEscolar)->with('msg', 'Vinculo Estabelecido com sucesso!');
    }
}
