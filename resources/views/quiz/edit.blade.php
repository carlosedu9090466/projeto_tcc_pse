@extends('layouts.main')

@section('title', 'Editando: ' . $quiz->nome_quiz)

@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Edite os dados</h1>
        <form action="/quiz/update/{{ $quiz->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome" class="">Titulo do Quiz:</label>
                <input type="text" class="form-control" id="nome_quiz" name="nome_quiz" value="{{ $quiz->nome_quiz }}"
                    placeholder="Quiz">
                @if ($errors->has('nome_quiz'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome_quiz') ? $errors->first('nome_quiz') : '' }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label for="date">Data Inicial</label>
                <input type="date" class="form-control" id="date_inicio_quiz" name="date_inicio_quiz"
                    value="{{ date('Y-m-d', strtotime($quiz->date_inicio_quiz)) }}">
            </div>

            <div class="form-group">
                <label for="date">Data fim</label>
                <input type="date" class="form-control" id="date_fim_quiz" name="date_fim_quiz"
                    value="{{ date('Y-m-d', strtotime($quiz->date_fim_quiz)) }}">
            </div>

            <div class="form-group">
                <label for="title">Status do evento</label>
                <select name="status_quiz" id="status_quiz" class="form-control">
                    <option value="0" {{ $quiz->status_quiz == 0 ? 'selected' : '' }}>Inativo</option>
                    <option value="1" {{ $quiz->status_quiz == 1 ? 'selected' : '' }}>Ativo</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="Editar os Dados">
        </form>
    </div>


@endsection
