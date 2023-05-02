@extends('layouts.main')

@section('title', 'Editando: ' . $doenca->nome)

@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Edite os dados</h1>
        <form action="/doenca/update/{{ $doenca->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome" class="">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $doenca->nome }}"
                    placeholder="Nome da Doença">
                @if ($errors->has('nome'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label for="sintomas" class="">Sintomas:</label>
                <textarea name="sintomas" id="sintomas" class="form-control" placeholder="informe os sintomas da doença">{{ $doenca->sintomas }}</textarea>
                @if ($errors->has('sintomas'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('sintomas') ? $errors->first('sintomas') : '' }}
                    </div>
                @endif
            </div>
            <input type="submit" class="btn btn-primary" value="Editar os Dados">
        </form>
    </div>


@endsection
