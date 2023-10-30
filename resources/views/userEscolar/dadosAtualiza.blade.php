@extends('layouts.menuEscolar')

@section('title', 'Atualizando Dados Cadastrais')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Atualização cadastral</h1>
        @isset($userEscolar)
            <form action="/userEscolar/update/{{ $userEscolar->id }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="user_id" value="{{ $userEscolar->user_id }}">
            @else
                <form action="/userEscolar" method="POST">
                    @csrf
        @endif

        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{$userEscolar ? $userEscolar->cpf : ''}}"
                placeholder="Digite o seu CPF">
            @if ($errors->has('cpf'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="telefone">telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{$userEscolar ? $userEscolar->telefone : ''}}"
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
                    <option>Selecione o sexo...</option>
                    <option value="0" {{$responsavel && $responsavel->sexo === 0 ? 'selected' : ''}} >Masculino</option>
                    <option value="1" {{$responsavel && $responsavel->sexo === 1 ? 'selected' : ''}}>Feminino</option>
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
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
                value="{{ $userEscolar->data_nascimento }}">
        </div>

        <input type="submit" class="btn btn-primary" value="Atualizar Dados">
        </form>
    </div>

@endsection
