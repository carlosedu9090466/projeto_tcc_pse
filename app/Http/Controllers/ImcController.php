<?php

namespace App\Http\Controllers;

use App\Models\Imc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ImcController extends Controller
{
    public function store(Request $request)
    {
        $altura = Imc::validaStringNumerica($request->altura);
        $peso = Imc::validaStringNumerica($request->peso);

        if ($peso && $altura && !empty($request->dia_registrado)) {
            $resultImc = Imc::calcularImc($altura, $peso);
            $grauImc = Imc::grauImc($resultImc);

            $imc = new Imc;
            $imc->id_aluno = $request->id_aluno;
            $imc->peso = $peso;
            $imc->altura = $altura;
            $imc->imc = $resultImc;
            $imc->grau_imc = $grauImc;
            $imc->dia_acompanhado = $request->dia_registrado;
            $imc->save();

            return redirect('/agente/acompanhamento/' . $request->id_aluno . '&' . $request->id_turma)->with('msg', 'IMC cadastrado com sucesso!');
        } else {
            return redirect('/agente/acompanhamento/' . $request->id_aluno . '&' . $request->id_turma)->with('msg', 'o peso ou altura não estão corretos!');
        }
    }
}
