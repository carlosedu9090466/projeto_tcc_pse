@extends('layouts.main')

@section('title', 'PSE - Questionário')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Questionário</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-question-container">
        @if (count($quizs) > 0)
            <a href="/quiz/create">
                Crie o seu Questionário
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data Inicial</th>
                        <th scope="col">Data Fim</th>
                        <th scope="col">Status</th>
                        <th scope="col">Vincular perguntas</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($quizs as $quiz)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $quiz->nome_quiz }}</td>
                            <td>{{ date('d/m/Y', strtotime($quiz->date_inicio_quiz)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($quiz->date_fim_quiz)) }}</td>
                            <td>{{ $quiz->status_quiz == 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td>
                                <a href="/quiz/vincular/{{ $quiz->id }}" class="btn btn-info">
                                    <ion-icon name="reader-outline"></ion-icon>
                                    Vincular perguntas
                                </a>
                            </td>
                            {{-- editar e excluir --}}
                            <td>
                                <a href="/quiz/edit/{{ $quiz->id }}" class="btn btn-info edit-btn">
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
                            {{-- end --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- modal para delete --}}
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Deletar: {{ $quiz->nome_quiz }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>Todos os dados referente ao questionário serão deletadas!</h4>
                        </div>
                        <form action="/quiz/{{ $quiz->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end - Modal --}}
        @else
            <p>Há não Questionário no banco de dados, <a href="/quiz/create">Crie o Questionário</a></p>
        @endif
    </div>

@endsection
