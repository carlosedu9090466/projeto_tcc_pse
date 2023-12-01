<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doenca;
use App\Repositories\DoencaRepository;

class DoencaController extends Controller
{

    private DoencaRepository $doencaRepository;
    private Doenca $doenca;

    public function __construct(DoencaRepository $doencaRepository, Doenca $doenca)
    {
        $this->doencaRepository = $doencaRepository;
        $this->doenca = $doenca;
    }

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
        //validação dos dados
        $request->validate($this->doenca->regras(), $this->doenca->feedback());
        
        $this->doencaRepository->createDoenca($request);

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

    public function deletecreate($id)
    {
        $doenca = Doenca::findOrfail($id);

        return view('doenca.delete', ['doenca' => $doenca]);
    }

    //Deletar uma doença

    public function destroy($id)
    {

        Doenca::findOrFail($id)->delete();
        return redirect('/doenca/home')->with('msg', 'Dado excluido com sucesso!');
    }
}
