<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //page home
    public function index()
    {
        $search = request('search');
        if ($search) {
            $escola = Escola::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            //pegar todos os eventos(dados) do banco
            $escola = Escola::all();
        }

        //view welcome
        return view('home', ['escola' => $escola, 'search' => $search]);
    }
}
