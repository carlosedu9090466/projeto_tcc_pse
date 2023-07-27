@extends('layouts.menuEscolar')

@section('title', 'Turmas')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turmas - {{ $escola->nome }}</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-question-container">
        @if (count($turmas) > 0)
            <a href="/turmas/create/{{ $escola->id }}">
                Criar Turmas
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
            <a href="/alunos/create/{{ $escola->id }}">
                Matricular Aluno
                <ion-icon name="school-outline">
                </ion-icon>
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ensino</th>
                        <th scope="col">Serie</th>
                        <th scope="col">turno</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Ano</th>
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
                                {{ date('d/m/Y', strtotime($turma->vigencia_inicial)) }} ||
                                {{ date('d/m/Y', strtotime($turma->vigencia_final)) }}
                            </td>
                            <td>
                                <a href="/turmas/edit/{{ $turma->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#staticBackdrop">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há turmas criadas nesse período, <a href="/turmas/create/{{ $escola->id }}">Criar Turmas</a></p>
        @endif
    </div>

@endsection
