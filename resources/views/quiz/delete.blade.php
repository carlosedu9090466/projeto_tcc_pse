@extends('layouts.main')

@section('title', 'PSE - Questionario')

@section('content')

    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Deseja realmente fazer a operação?</h4>
        <p>
            Caso faça a operação de deletar o dado. Todos as perguntas vinculadas a {{ $doenca->nome }}
            Caso faça a operação os dados
        </p>
        <hr>

        <div class="btn-group" role="group" aria-label="Exemplo básico">
            <a href="javascript:history.back()" class="btn btn-secondary mr-3">Voltar</a>
            <form action="/quiz/{{ $quiz->id }}" method="POST">
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
