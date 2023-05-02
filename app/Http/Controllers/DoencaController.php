<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doenca;


class DoencaController extends Controller
{

    //home doencas - page
    public function index()
    {
        $doencas = Doenca::all();

        return view('doenca.home', ['doencas' => $doencas]);
    }

    public function create()
    {
        return view('doenca.create');
    }

    public function store(Request $request)
    {

        $doenca = new Doenca;

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

        $doenca->nome = $request->nome;
        $doenca->sintomas = $request->sintomas;
        $doenca->save();

        return redirect('/doenca/home')->with('msg', 'Doença cadastrada com sucesso!');
    }

    public function edit($id)
    {

        $doenca = Doenca::findOrFail($id);

        return view('doenca.edit', ['doenca' => $doenca]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        Doenca::findOrFail($request->id)->update($data);

        return redirect('/doenca/home')->with('msg', 'Dado editado com sucesso!');
    }

    //Deletar uma doença

    public function destroy($id)
    {

        //deletar as questions referente a doenca
        //Doenca::with('question')->findOrFail($id)->delete();
        Doenca::findOrFail($id)->delete();


        return redirect('/doenca/home')->with('msg', 'Dado excluido com sucesso!');
    }
}
