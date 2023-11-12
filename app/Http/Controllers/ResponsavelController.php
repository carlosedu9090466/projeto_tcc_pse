<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Responsavel;
use App\Models\Sexo;
use App\Models\User;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
    public function index()
    {
        $cpf = Responsavel::where('user_id', '=', auth()->user()->id)->pluck('cpf')->toArray();
        //dd($cpf);
        $alunosVinculados = Responsavel::AlunosVinculadosCpfResponsavel($cpf);
        //dd($alunosVinculados);
        return view('responsavel.home', ['alunosVinculados' => $alunosVinculados]);
    }

    public function indexTodos()
    {
        $responsaveis = User::where('role_id', '=', 4)->get();
        return view('responsavel.visualizarTodosRes', ['responsaveis' => $responsaveis]);
    }


    public function create()
    {
        //atualizar os dados na table responsavels
        $responsavel_id = auth()->user()->id;
        //verificar o dados restantes na table responsavels
        $responsavel = Responsavel::where('user_id', $responsavel_id)->first();
        $generos = Genero::all();
        $sexos = Sexo::all();
        return view('responsavel.create', ['responsavel' => $responsavel, 'generos' => $generos, 'sexos' => $sexos]);
    }

    public function store(Request $request)
    {
        $responsavel_id = auth()->user()->id;

        $regras = [
            'cpf' => 'required|unique:responsavels',
            'dataNascimento' => 'required',
            'sexo' => 'required',
            'genero' => 'required',
            //'escola_id' => 'exists:escolas,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'unique' => 'CPF já cadastrado'
            //'escola_id.exists' => 'A escola informada não existe'
        ];
        $request->validate($regras, $feedback);


        $responsavel = new Responsavel;

        $responsavel->cpf = $request->cpf;
        $responsavel->sexo = $request->sexo;
        $responsavel->genero = $request->genero;
        $responsavel->dataNascimento = $request->dataNascimento;
        $responsavel->user_id = $responsavel_id;

        $responsavel->save();



        return redirect('/responsavel/home')->with('msg', 'Dados Inseridos com sucesso!');
    }

    public function update(Request $request)
    {

        $data = $request->all();

        Responsavel::findOrFail($request->id)->update($data);

        return redirect('/responsavel/home')->with('msg', 'Dados Atualizados com sucesso!');
    }
}
