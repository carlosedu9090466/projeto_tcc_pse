@extends('layouts.main')

@section('title', 'PSE - Vincule as perguntas')

@section('content')


    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Vincule suas pergunta ao Quiz: {{ $quiz->nome_quiz }}</h1>
        <form action="/quiz/vincular" method="POST">
            @csrf
            <div class="container-fluid d-flex flex-wrap">
                @foreach ($questions as $question)
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 15rem; margin: 5px;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $question->doencas->nome }}</h5>
                                    <p class="card-text">Pergunta:{{ $question->pergunta }}</p>
                                    {{-- <p class="card-text">Sintomas: {{ $question->doencas->sintomas }}</p> --}}
                                    <input type="text" name="quiz_id" value="{{ $quiz->id }}" hidden>
                                    <input type="checkbox" name="question[]" value="{{ $question->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="submit" class="btn btn-primary" value="Criar Questionário">
        </form>
    </div>


@endsection
