@extends('layouts.main')

@section('title', 'Criando um questionário')

@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Crie seu Questionário</h1>
        <form action="/quiz" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Digite o nome do questionamento:</label>
                <input type="text" class="form-control" id="nome_quiz" name="nome_quiz" minlength="5" maxlength="100"
                    placeholder="Digite o nome do questionário">

                @if ($errors->has('nome_quiz'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome_quiz') ? $errors->first('nome_quiz') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="date">Data Inicial</label>
                <input type="date" class="form-control" id="date_inicio_quiz" name="date_inicio_quiz">
            </div>

            <div class="form-group">
                <label for="date">Data fim</label>
                <input type="date" class="form-control" id="date_fim_quiz" name="date_fim_quiz">
            </div>

            <div class="form-group">
                <label for="title">Status do evento</label>
                <select name="status_quiz" id="status_quiz" class="form-control">
                    <option value="0">Inativo</option>
                    <option value="1">Ativo</option>
                </select>
            </div>

            <input type="submit" class="btn btn-primary" value="Criar Questionário">
        </form>
    </div>

@endsection
