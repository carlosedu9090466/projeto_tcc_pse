<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use Illuminate\Http\Request;

class AcompanhamentoController extends Controller
{

    public function storeAcompanhamento(Request $request)
    {
        $regras = [
            'dia_observado' => 'required',
            'observacao' => 'required|min:5|max:600',
            'status_acompanhamento' => 'required',

        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'observacao.min' => 'A Observação deve ter no mínino 5 caracteres',
            'observacao.max' => 'A Observação deve ter no máximo 100 caracteres',
        ];
        $request->validate($regras, $feedback);

        $acompanhamento = new Acompanhamento;

        $acompanhamento->id_turma = $request->id_turma;
        $acompanhamento->id_aluno = $request->id_aluno;
        $acompanhamento->id_agente = $request->id_agente;
        $acompanhamento->dia_observado = $request->dia_observado;
        $acompanhamento->observacao = $request->observacao;
        $acompanhamento->status_acompanhamento = $request->status_acompanhamento;

        // salvando no banco os dados vindo do form através do request
        $acompanhamento->save();

        return redirect('/agente/acompanhamento/' . $request->id_aluno . '&' . $request->id_turma)->with('msg', 'questionario cadastrado com sucesso!');
    }
}
