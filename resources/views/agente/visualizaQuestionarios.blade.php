@extends('layouts.menuAgente')

@section('title', 'Turma Aluno')

@section('content')


<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h4>Questionários disponiveis</h4>
</div>

<div class="col-md-10 offset-md-1 dashboard-turmas-container">
    @if (count($questionariosDisponiveisAluno) > 0)
    <div class="row">
        @foreach ($questionariosDisponiveisAluno as $quiz)
        <div class="col-sm-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Titulo: {{$quiz->nome_quiz}}</h5>
                    <p class="card-text">Data Inicio: {{date('d/m/Y', strtotime($quiz->date_inicio_quiz))}}</p>
                    <p class="card-text">Data fim: {{date('d/m/Y', strtotime($quiz->date_fim_quiz))}}</p>
                    <a href="/agente/acompanhamento/{{$quiz->id_aluno}}&{{$quiz->id_turma}}&{{$quiz->id}}" class="btn btn-primary">Exibir respostas</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>Não há Questionários respondidos pelo aluno!</p>
    @endif
</div>

@endsection