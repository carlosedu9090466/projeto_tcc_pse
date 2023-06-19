<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class EscolaController extends Controller
{
    public function create()
    {
        return view('escola.create');
    }

    public function store(Request $request)
    {

        $escola = new Escola;

        $regras = [
            'nome' => 'required|min:3|max:100',
            'inep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'rural' => 'required',
            'localidade_id' => 'required'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.'
        ];

        $request->validate($regras, $feedback);

        //$doenca->nome = $request->nome;
        //$doenca->sintomas = $request->sintomas;
        //$doenca->save();

        return redirect('/doenca/home')->with('msg', 'Doença cadastrada com sucesso!');
    }
}
