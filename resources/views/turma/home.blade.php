@extends('layouts.menuEscolar')

@section('title', 'Turmas')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turmas - {{ $escola->nome }}</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-question-container">
        @if (count($turmas) > 0)
            <a href="/turma/create">
                Criar Turmas
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Serie</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Alunos</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        @else
            <p>Não há turmas criadas nesse período, <a href="/turma/create">Criar Turmas</a></p>
        @endif
    </div>

@endsection
