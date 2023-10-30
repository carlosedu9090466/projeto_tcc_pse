@extends('layouts.menuReponsavel')

@section('title', 'Responder - Quiz')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Questionarios Abertos</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-doencas-container">
        @if (count($quizs) > 0)

            <div class="row">
                @foreach ($quizs as $quizAbertos)
                    <div class="col-md-3 offset-md-1 mt-3">
                        <form action="/responsavel/responderQuiz" method="POST">
                            @csrf
                            <div class="card" style="width: 22rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $quizAbertos->nome_quiz }}</h5>
                                    <p class="card-text">data Inicio:
                                        {{ date('d/m/Y', strtotime($quizAbertos->date_inicio_quiz)) }}</p>
                                    <p class="card-text">data Fim:
                                        {{ date('d/m/Y', strtotime($quizAbertos->date_fim_quiz)) }}</p>
                                    <p class="card-text">Status: {{ $quizAbertos->status_quiz == 1 ? 'Aberto' : 'Fechado' }}
                                    </p>
                                    {{-- <a href="/responsavel/responderQuiz/create" class="btn btn-primary">Responder
                                    Questionario</a> --}}
                                    <input type="hidden" name="id_quiz" id="id_quiz" value="{{ $quizAbertos->id }}">
                                    <input type="hidden" name="id_turma" id="id_turma"
                                        value="{{ $dado_aluno['id_turma'] }}">
                                    <input type="hidden" name="id_aluno" id="id_aluno"
                                        value="{{ $dado_aluno['id_aluno'] }}">
                                    <input type="hidden" name="cpf_responsavel" id="cpf_responsavel"
                                        value="{{ $dado_aluno['cpf_responsavel'] }}">
                                    <input type="hidden" name="status_aluno" id="status_aluno"
                                        value="{{ $dado_aluno['status_aluno'] }}">
                                    <input type="submit" class="btn btn-primary" value="Visualizar Questionário">
                                </div>

                            </div>
                        </form>

                    </div>
                @endforeach
            </div>
        @else
            <p>Não há Questionário disponível, <a href="/responsavel/home">Voltar</a></p>
        @endif
    </div>

@endsection
