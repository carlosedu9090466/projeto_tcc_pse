<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
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


    public function create()
    {
        //atualizar os dados na table responsavels
        $responsavel_id = auth()->user()->id;
        //verificar o dados restantes na table responsavels
        $responsavel = Responsavel::where('user_id', $responsavel_id)->get();
        //dd($responsavel[0]);
        return view('responsavel.create', ['responsavel' => $responsavel[0]]);
    }

    public function store(Request $request)
    {
        $responsavel_id = auth()->user()->id;

        $regras = [
            'cpf' => 'required|unique:responsavels',
            'dataNascimento' => 'required',
            'sexo' => 'required',
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
