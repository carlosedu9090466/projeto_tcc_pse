@extends('layouts.menuAgente')

@section('title', 'Turma Aluno')

@section('content')


    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Resposta - Questionário do {{ $aluno->nome }}</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($alunoResposta) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doença</th>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Resposta</th>
                        <th scope="col">Data Resposta</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($alunoResposta as $resp)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $resp->doenca }}</td>
                            <td>{{ $resp->pergunta }}</td>
                            <td>{{ $resp->resposta }}</td>
                            <td>{{ date('d/m/Y', strtotime($resp->data_resposta)) }}</td>
                            <td>
                                <a href="/agente/acompanhamento/{{ $resp->id_pergunta_quiz }}"
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
            <p>Não há Respostas desse aluno!</p>
        @endif
    </div>

@endsection
