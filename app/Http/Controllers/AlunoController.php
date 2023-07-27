<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function create($id)
    {
        $escola = Escola::findOrfail($id);

        return view('aluno.create', ['escola' => $escola]);
    }
}
