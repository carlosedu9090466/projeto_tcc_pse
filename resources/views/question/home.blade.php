@extends('layouts.main')

@section('title', 'PSE - Perguntas')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Perguntas</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-question-container">
        @if (count($questions) > 0)
            <a href="/question/create">
                Inserir perguntas
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Discursiva</th>
                        <th scope="col">Doença</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $question->pergunta }}</td>
                            <td>{{ $question->discursiva == 0 ? 'Não' : 'Sim' }}</td>
                            <td>{{ $question->doencas->nome }}</td>
                            {{-- editar e excluir --}}
                            <td>
                                <a href="/question/edit/{{ $question->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <form action="/question/{{ $question->id }}" method="POST">
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
        @else
            <p>Há não perguntas no banco de dados, <a href="/question/create">Inserir perguntas</a></p>
        @endif
    </div>

@endsection
