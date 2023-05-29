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
                                <form action="/quiz/{{ $quiz->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Deletar
                                    </button>
                                </form>
                            </td>
                            {{-- end --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- perguntas --}}

            {{-- <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach ($questions as $question)
                                        <div class="col-md-6">
                                            <div class="card" style="width: 20rem; margin: 5px;">
                                                <img src="..." class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $question->doencas->nome }}</h5>
                                                    <h4 class="card-title">{{ $question->pergunta }}</h4>
                                                    <p class="card-text">{{ $question->doencas->sintomas }}</p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        @else
            <p>Há não Questionário no banco de dados, <a href="/quiz/create">Crie o Questionário</a></p>
        @endif
    </div>

@endsection
