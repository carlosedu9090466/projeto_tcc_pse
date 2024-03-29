@extends('layouts.main')

@section('title', 'PSE - Questionario')

@section('content')

    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Deseja realmente fazer a operação?</h4>
        <p>
            Caso faça a operação de deletar o dado. Todas as perguntas relacionadas ao Questionário serão deletadas e também
            as respostas dos alunos vinculados ao mesmo!
        </p>
        <p>Pergutas vinculas: {{ $quiz_question }}</p>
        <p>Total de alunos com respostas vinculadas: {{ $respostas_alunos }}</p>
        <hr>

        <div class="btn-group" role="group" aria-label="Exemplo básico">
            <a href="javascript:history.back()" class="btn btn-secondary mr-3">Voltar</a>
            <form action="/quiz/{{ $quiz->id }}&&{{ $respostas_alunos }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <ion-icon name="trash-outline"></ion-icon>
                    Confirmar Exclusão
                </button>
            </form>
        </div>

    </div>
@endsection
