<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficosController extends Controller
{
    //

    public function index()
    {

        $alunosData = Aluno::select([
            DB::raw('genero'),
            DB::raw('COUNT(id) as total')
        ])
            ->groupBy('genero')
            ->get();

        foreach ($alunosData as $aluno) {
            $alunoGenero[] = $aluno->genero;
            $totalGenero[] = $aluno->total;
        }

        $dadosGerais = Escola::select('municipios.nome as municipio', 'escolas.nome as escola')
            ->join('municipios', 'escolas.localidade_id', '=', 'municipios.id')
            ->join('turmas', 'turmas.escola_id', '=', 'escolas.id')
            ->join('turma_aluno', 'turma_aluno.id_turma', '=', 'turmas.id')
            ->groupBy('municipios.nome', 'escolas.nome')
            ->selectRaw('COUNT(DISTINCT turma_aluno.id_aluno) as alunos')
            ->get();

        return view('dashboard.dashboard', ['alunoGenero' => $alunoGenero, 'totalGenero' => $totalGenero, 'dadosGerais' => $dadosGerais]);
    }
}
