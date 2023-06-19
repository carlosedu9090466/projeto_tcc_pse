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
            'sintomas' => 'required|min:5|max:2000'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'nome.min' => 'o campo nome deve ter no mínino 3 caracteres',
            'nome.max' => 'o campo nome deve ter no máximo 100 caracteres',
            'sintomas.min' => 'o campo sintomas deve ter no mínino 5 caracteres',
            'sintomas.max' => 'o campo sintomas deve ter no máximo 2000 caracteres'
        ];

        $request->validate($regras, $feedback);

        //$doenca->nome = $request->nome;
        //$doenca->sintomas = $request->sintomas;
        //$doenca->save();

        return redirect('/doenca/home')->with('msg', 'Doença cadastrada com sucesso!');
    }
}
