@extends('layouts.menuReponsavel')

@section('title', 'Ambiente - responsavel')


@section('content')

    <div class="container">
        <h3 class="text-center">Alunos associados</h3>

        <div class="row">
            @foreach ($alunosVinculados as $aluno)
                <div class="col-md-3 offset-md-1 mt-3">
                    <form action="/responsavel/responderQuiz/create" method="POST">
                        @csrf
                        <div class="card" style="width: 22rem;">
                            <div class="card-body">
                                <h5 class="card-title">Aluno: {{ $aluno->nome }}</h5>
                                <p class="card-text">Turma: {{ $aluno->serie }} - {{ $aluno->turno }}</p>
                                <p class="card-text">Status: {{ $aluno->status_aluno_turma }}</p>
                                {{-- <a href="/responsavel/responderQuiz/create" class="btn btn-primary">Responder
                                    Questionario</a> --}}
                                <input type="hidden" name="id_turma" id="id_turma" value="{{ $aluno->id_turma }}">
                                <input type="hidden" name="id_aluno" id="id_aluno" value="{{ $aluno->id }}">
                                <input type="hidden" name="cpf_responsavel" id="cpf_responsavel"
                                    value="{{ $aluno->cpf }}">
                                <input type="hidden" name="status_aluno" id="status_aluno"
                                    value="{{ $aluno->status_aluno_turma }}">
                                <input type="submit" class="btn btn-primary" value="Exibir Questionários">
                            </div>

                        </div>
                    </form>

                </div>
            @endforeach
        </div>

    </div>

@endsection
