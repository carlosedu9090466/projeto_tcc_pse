@extends('layouts.menuAgente')

@section('title', 'Turmas Escolas')

@section('content')


    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turmas Abertas</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($turmas) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ensino</th>
                        <th scope="col">Serie</th>
                        <th scope="col">Turno</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($turmas as $turma)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $turma->tipo_ensino }}</td>
                            <td>{{ $turma->serie }}</td>
                            <td>{{ $turma->turno }}</td>
                            <td>{{ $turma->sala }}</td>
                            <td>
                                <a href="/agente/visualizarAlunos/{{ $turma->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="school-outline"></ion-icon>
                                    Visualizar Alunos
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há Escolas Vinculadas a esse Agente de saúde!, Informe o Admistrador!</p>
        @endif
    </div>

@endsection
