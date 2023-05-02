@extends('layouts.main')

@section('title', 'Registrar uma doença')

{{-- conteudos dessa pagina --}}
@section('content')


    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastro de perguntas</h1>
        <form action="/question" method="POST">
            @csrf

            <div class="form-group">
                <label for="doenca">Vincule a enfermidade:</label>
                <select class="form-control" id="doenca_id" name="doenca_id">
                    <option value="0">-- Selecione uma doença</option>
                    @foreach ($doencas as $doenca)
                        <option value="{{ $doenca->id }}">
                            {{ $doenca->nome }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('doenca_id'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('doenca_id') ? $errors->first('doenca_id') : '' }}
                    </div>
                @endif

            </div>

            <div id="formulario">
                <div class="form-group">
                    <label for="nome">Digite a pergunta:</label>
                    <input type="text" class="form-control" id="pergunta[]" name="pergunta[]" minlength="5"
                        maxlength="100" placeholder="?Digite a pergunta?">

                    @if ($errors->has('pergunta'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->has('pergunta') ? $errors->first('pergunta') : '' }}
                        </div>
                    @endif

                    <button type="button" onclick="adicionarCampo()" class="btn-mais-pergunta">
                        <ion-icon name="add-outline"></ion-icon>
                    </button>
                </div>

            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" value="1" id="discursiva" name="discursiva">
                <label class="form-check-label" for="exampleCheck1">Pergunta é discursiva?</label>
            </div>
            <input type="submit" class="btn btn-primary" value="Registrar Pergunta">
        </form>
    </div>

@endsection
