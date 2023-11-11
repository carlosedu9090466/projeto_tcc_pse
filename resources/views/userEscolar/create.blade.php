@extends('layouts.menuEscolar')

@section('title', 'Atualizando Dados Cadastrais')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1 class="text-center">Cadastrar dados ADM Escolar</h1>

        <form action="/userEscolar" method="POST">
            @csrf

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
                    placeholder="Digite o seu CPF">
                @if ($errors->has('cpf'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="telefone">telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone"
                    placeholder="Digite o seu celular">
                @if ($errors->has('telefone'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" id="sexo">
                        <option>Selecione o seu gênero</option>
                        @foreach ($sexos as $sexo)
                            <option value="{{ $sexo->sexo }}">
                                {{ $sexo->sexo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('sexo'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('sexo') ? $errors->first('sexo') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="sexo">Gênero:</label>
                    <select class="form-control" name="genero" id="genero">
                        <option>Selecione o seu gênero</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->genero }}">
                                {{ $genero->genero }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('sexo'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('sexo') ? $errors->first('sexo') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="date">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
            </div>

            <input type="submit" class="btn btn-primary" value="Inserir Dados">
        </form>
    </div>

@endsection
