<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Escolar;
use App\Models\UserEscolar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserEscolarController extends Controller
{
    //home doencas - page
    public function index()
    {
        $escolas = Escola::all();
        $userEscolar = UserEscolar::all();
        $user = User::with('userEscolar')->get();
        //dd($user);
        return view('userEscolar.home', ['userEscolar' => $userEscolar, 'escolas' => $escolas]);
    }

    public function create()
    {
        //exibir apenas a permissão do User Escolar
        $roles = Role::where('id', '=', 2)->get();
        //dd($roles);
        return view('userEscolar.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {

        $userEscolar = new UserEscolar;
        $user_id = Auth::user()->id;

        if (!$user_id) {
            return redirect('/login')->with('msg', 'Usuário não encontrado!');
        }

        $regras = [
            //'nome' => 'required|min:3|max:100',
            'cpf' => 'required',
            'telefone' => 'required',
            //'email' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required',
            //'user_id' => 'required'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
        ];

        $request->validate($regras, $feedback);

        //$userEscolar->nome = $request->nome;
        $userEscolar->cpf = $request->cpf;
        $userEscolar->telefone = $request->telefone;
        //$userEscolar->email = $request->email;
        $userEscolar->sexo = $request->sexo;
        $userEscolar->user_id = $user_id;
        $userEscolar->data_nascimento = $request->data_nascimento;
        $userEscolar->save();

        return redirect('/userEscolar/home')->with('msg', 'Usuário Escolar Atulizado as Informações com sucesso!');
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

    public function deletecreate(int $idUser, int $idEscola)
    {

        User_Escolar::where('user_id', '=', $idUser)->where('escola_id', '=', $idEscola)->delete();
        return redirect('/userEscolar/vincularEscola/' . $idUser)->with('msg', 'Vinculo excluido com sucesso!');
    }

    public function deleteUserEscolar($id)
    {
        $vinculoUser = User_Escolar::where('user_id', '=', $id)->first();
        if ($vinculoUser) {
            return redirect('/userEscolar/home')->with('msg', 'Não é possível deletar, pois o usuário possui vinculo!');
        }
        UserEscolar::where('id', $id)->delete();
        return redirect('/userEscolar/home');
    }
}
