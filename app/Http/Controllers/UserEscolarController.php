<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Genero;
use App\Models\Role;
use App\Models\Sexo;
use App\Models\User;
use App\Models\User_Escolar;
use App\Models\UserEscolar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserEscolarController extends Controller
{
    //home doencas - page
    public function index()
    {
        $escolas = Escola::all();
        //$userEscolar = UserEscolar::all();

        $userEscolar = User::where('role_id', '=', 2)->get();

        return view('userEscolar.home', ['userEscolar' => $userEscolar, 'escolas' => $escolas]);
    }

    public function homeUser()
    {
        $id = auth()->user()->id;

        $userEscolar = UserEscolar::where('user_id', '=', $id)->first();

        if (!is_null($userEscolar)) {
            $escolaVinculos = UserEscolar::with('UserEscolarVinculo')->findOrFail($userEscolar->id);

            return view('userEscolar.homeUser', ['escolaVinculos' => $escolaVinculos]);
        } else {
            return view('userEscolar.homeUser');
        }
    }


    public function create()
    {
        $userEscolar_id = auth()->user()->id;

        $userEscolar = UserEscolar::where('user_id', $userEscolar_id)->count();
        $generos = Genero::all();
        $sexos = Sexo::all();

        if ($userEscolar == 0) {
            return view('userEscolar.create', ['generos' => $generos, 'sexos' => $sexos]);
        }

        $userEscolar = UserEscolar::where('user_id', $userEscolar_id)->get();


        return view('userEscolar.dadosAtualiza', ['userEscolar' => $userEscolar[0], 'generos' => $generos, 'sexos' => $sexos]);
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
            'genero' => 'required',
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
        $userEscolar->genero = $request->genero;
        $userEscolar->user_id = $user_id;
        $userEscolar->data_nascimento = $request->data_nascimento;
        $userEscolar->save();

        return redirect('/userEscolar/homeUser')->with('msg', 'Usuário Escolar Atulizado as Informações com sucesso!');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        UserEscolar::findOrFail($request->id)->update($data);

        return redirect('/userEscolar/homeUser')->with('msg', 'Dados Atualizados com sucesso!');
    }


    public function createUserEscolar($id)
    {
        //$userEscolar = UserEscolar::findOrfail($id)->first();

        $userEscolar = UserEscolar::where('user_id', '=', $id)->first();
        //bugado

        if ($userEscolar == null && is_null($userEscolar)) {

            return redirect('/userEscolar/home')->with('msg', 'O Usuário Escolar precisar completar os dados cadastrias para pode vincular a escola!');
        } else {
            $escolas = Escola::all();
            $userAtivo = User::where('id', '=', $id)->get();

            $UserEscolaVinculos = UserEscolar::with('UserEscolarVinculo')->findOrFail($userEscolar->id);

            return view('userEscolar.createVinculoEscola', ['userEscolar' => $userEscolar, 'userAtivo' => $userAtivo[0], 'escolas' => $escolas, 'UserEscolaVinculos' => $UserEscolaVinculos]);
        }
    }

    public function createVinculo(Request $request)
    {

        //verifica se possui vinculo com a escola selecionada para salvar!
        $existeVinculo = User_Escolar::where('escola_id', '=', $request->escola_id)->where('user_id', '=', $request->userEscolar)->first();
        if ($existeVinculo) {
            return redirect('/userEscolar/vincularEscola/' . $request->userId)->with('msg', 'Usuário já possui vinculado com essa escola!');
        }

        $vinculoUserEscolar = new User_Escolar;
        $vinculoUserEscolar->user_id = $request->userEscolar;
        $vinculoUserEscolar->escola_id = $request->escola_id;
        $vinculoUserEscolar->status_user_escolar = $request->userAtivo;
        $vinculoUserEscolar->save();

        //return redirect('/userEscolar/home')->with('msg', 'Vinculo Estabelecido com sucesso!');
        return redirect('/userEscolar/vincularEscola/' . $request->userId)->with('msg', 'Vinculo Estabelecido com sucesso!');
    }

    public function deletecreate(int $idUser, int $idEscola)
    {

        User_Escolar::where('user_id', '=', $idUser)->where('escola_id', '=', $idEscola)->delete();
        return redirect('/userEscolar/vincularEscola/' . $idUser)->with('msg', 'Vinculo excluido com sucesso!');
    }

    public function deleteUserEscolar($id)
    {

        $userEscolar = UserEscolar::where('user_id', '=', $id)->get()->pluck('id')->toArray();

        if ($userEscolar && !empty($userEscolar)) {
            $vinculoUser = User_Escolar::where('user_id', '=', $userEscolar[0])->first();
            if ($vinculoUser && $vinculoUser != null) {
                return redirect('/userEscolar/home')->with('msg', 'Não é possível deletar, pois o usuário possui vinculo com escolas!');
            }
            UserEscolar::where('user_id', $id)->delete();
            User::where('id', $id)->delete();
            return redirect('/userEscolar/home')->with('msg', 'Usuário Escolar deletado com sucesso!');
        } else {
            User::where('id', $id)->delete();
            return redirect('/userEscolar/home')->with('msg', 'Usuário Escolar deletado com sucesso!');
        }
    }
}
