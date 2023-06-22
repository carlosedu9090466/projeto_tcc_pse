<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Municipio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //page home
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
        return view('home', ['escolas' => $escolas, 'search' => $search, 'municipios' => $municipios]);
    }
}
