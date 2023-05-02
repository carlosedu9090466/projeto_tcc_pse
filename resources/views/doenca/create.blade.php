@extends('layouts.main')

@section('title', 'Registrar uma doença')

{{-- conteudos dessa pagina --}}
@section('content')


    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Registre uma doença</h1>

        <form action="/doenca" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Doença">
                @if ($errors->has('nome'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label for="sintomas" class="">Sintomas:</label>
                <textarea name="sintomas" id="sintomas" value="{{ old('sintomas') }}" class="form-control"
                    placeholder="informe os sintomas da doença"></textarea>
                @if ($errors->has('sintomas'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('sintomas') ? $errors->first('sintomas') : '' }}
                    </div>
                @endif
            </div>
            <input type="submit" class="btn btn-primary" value="Registrar Doença">
        </form>
    </div>

@endsection
