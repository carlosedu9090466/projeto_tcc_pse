@extends('layouts.menuAgente')

@section('title', 'Turma Aluno')

@section('content')


    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Espelho da Turma - Respostas</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($alunos) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">data Nascimento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Status Matricula</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($alunos as $aluno)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->cpf_aluno }}</td>
                            <td>{{ date('d/m/Y', strtotime($aluno->dataNascimento)) }}</td>
                            <td>{{ $aluno->sexo }}</td>
                            <td>{{ $aluno->status_aluno_turma }}</td>
                            <td>
                                <a href="/agente/acompanhamento/{{ $aluno->id }}&{{ $aluno->id_turma }}"
                                    class="btn btn-info edit-btn">
                                    <ion-icon name="bandage-outline"></ion-icon>
                                    Visualizar Questionário
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há Alunos na turma!, Informe o Usuário Escolar!</p>
        @endif
    </div>

@endsection
