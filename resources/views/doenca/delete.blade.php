@extends('layouts.main')

@section('title', 'PSE - Controle de Doença')
{{-- DEPOIS ADICIONAR OS CARDS, pois terá as IMAGENS em cada doença --}}
{{-- conteudos dessa pagina --}}
@section('content')

    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Deseja realmente fazer a operação?</h4>
        <p>
            Caso faça a operação de deletar o dado. Todos as perguntas vinculadas a {{ $doenca->nome }}
            serão deletadas!
        </p>
        <hr>

        <div class="btn-group" role="group" aria-label="Exemplo básico">
            <a href="javascript:history.back()" class="btn btn-secondary mr-3">Voltar</a>
            <form action="/doenca/{{ $doenca->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <ion-icon name="trash-outline"></ion-icon>
                    Confirmar
                </button>
            </form>
        </div>

    </div>
@endsection
