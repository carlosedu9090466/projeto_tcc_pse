@extends('layouts.menuEscolar')

@section('title', 'Turmas')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turmas Abertas</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($turmasAbertas) > 0)
            <table class="table">
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

                    @foreach ($turmasAbertas as $turma)
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
                                <form action="/turmas/fechar/{{ $turma->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id_turma" id="id_turma" value="{{ $turma->id }}">
                                    <button type="submit" class="btn btn-warning"
                                        onclick="return confirm('Caso confirme, os alunos estarão disponíveis para associar novamente?')">
                                        @if ($turma->status_turma == 1)
                                            <ion-icon name="lock-open-outline"></ion-icon>
                                            <input type="hidden" name="status" value="0">
                                            Fechar Turma
                                        @else
                                            <ion-icon name="lock-closed-outline"></ion-icon>
                                            <input type="hidden" name="status" value="1">
                                            Abrir Turma
                                        @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
        @endif
    </div>




@endsection
