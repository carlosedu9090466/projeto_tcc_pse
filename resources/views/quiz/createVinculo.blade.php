@extends('layouts.main')

@section('title', 'PSE - Vincule as perguntas')

@section('content')


<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Vincule as perguntas ao Quiz</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-doencas-container">
    @if (count($questions) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Pergunta</th>
                <th scope="col">Doença</th>
                
            </tr>
        </thead>

        <tbody>
            <form action="/quiz/vincular" method="POST">
                @csrf
                @foreach ($questions as $question)
                <input type="text" name="quiz_id" value="{{ $quiz->id }}" hidden>
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td>
                        <input type="checkbox" name="question[]" value="{{$question->id}}">
                    </td>
                    <td>{{ $question->pergunta }}</td>
                    <td>{{ $question->doencas->nome }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <input type="submit" class="btn btn-primary" value="Inserir perguntas">
    </form>
    @else
    <p>Há não registro de doenças no banco de dados, <a href="/doenca/create">Inserir doença</a></p>
    @endif
</div>


@endsection