<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Municipio;
use Illuminate\Http\Request;

class EscolaController extends Controller
{

    public function index()
    {

        $search = request('search');
        $municipios = Municipio::all();

        if ($search) {
            $escolas = Escola::where(
                [
                    ['nome', 'like', '%' . $search . '%'],
                ]
            )->orWhere(
                [
                    ['inep', 'like', '%' . $search . '%']
                ]
            )->get();
        } else {
            //pegar todos os eventos(dados) do banco
            $escolas = Escola::with('EscolaMunicipioOne')->get();
        }

        //view welcome
        return view('escola.home', ['escolas' => $escolas, 'search' => $search, 'municipios' => $municipios]);
    }

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

        return redirect('/escola/home')->with('msg', 'Escola cadastrada com sucesso!');
    }

    public function destroy($id)
    {

        //deletar as questions referente a doenca
        //Doenca::with('question')->findOrFail($id)->delete();
        Escola::findOrFail($id)->delete();


        return redirect('/')->with('msg', 'Escola excluida com sucesso!');
    }
}
