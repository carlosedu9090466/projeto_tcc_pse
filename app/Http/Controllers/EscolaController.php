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
            'zona' => 'required',
            'localidade_id' => 'required'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.'
        ];

        $request->validate($regras, $feedback);

        $escola->nome = $request->nome;
        $escola->inep = $request->inep;
        $escola->rua = $request->rua;
        $escola->bairro = $request->bairro;
        $escola->numero = $request->numero;
        $escola->cep = $request->cep;
        $escola->rural = $request->zona;
        $escola->telefone = $request->telefone;
        $escola->localidade_id = $request->localidade_id;
        $escola->save();

        return redirect('/')->with('msg', 'Escola cadastrada com sucesso!');
    }
}
