@extends('layouts.menuEscolar')

@section('title', 'Turmas')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turmas - {{ $escola->nome }}</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($turmas) > 0)
            {{-- <a href="/turmas/create/{{ $escola->id }}">
                Criar Turmas
                <ion-icon name="add-circle-outline"></ion-icon>
            </a> --}}
            {{-- <a href="/alunos/create/{{ $escola->id }}">
                Matricular Aluno
                <ion-icon name="school-outline">
                </ion-icon>
            </a> --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="teste">#</th>
                        <th scope="col">Ensino</th>
                        <th scope="col" class="teste">Serie</th>
                        <th scope="col">turno</th>
                        <th scope="col" class="teste">Sala</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($turmas as $turma)
                        <tr>
                            <td scropt="row" class="teste">{{ $loop->index + 1 }}</td>
                            <td>{{ $turma->tipo_ensino }}</td>
                            <td class="teste">{{ $turma->serie }}</td>
                            <td>{{ $turma->turno }}</td>
                            <td class="teste">{{ $turma->sala }}</td>

                            <td>
                                {{ date('d/m/Y', strtotime($turma->vigencia_inicial)) }} ||
                                {{ date('d/m/Y', strtotime($turma->vigencia_final)) }}
                            </td>
                            <td>
                                <a href="/turmas/espelho/{{ $turma->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    visualizar
                                </a>
                                <a href="/turmas/edit/{{ $turma->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <!-- Button trigger modal -->
                                <form action="/turmas/{{ $turma->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Confirma excluir a turma?')">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Excluir
                                    </button>
                                </form>
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
