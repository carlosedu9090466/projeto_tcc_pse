@extends('layouts.menuAgente')

@section('title', 'Atualizando Dados Cadastrais')

@section('content')
    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Atualização cadastral</h1>
        @isset($agente)
            <form action="/agente/update/{{ $agente->id }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="user_id" value="{{ $agente->user_id }}">
            @else
                <form action="/agenteDados" method="POST">
                    @csrf
        @endif

        <div class="form-group">
            <label for="nome">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
                value="{{$agente ? $agente->cpf : ''}}" placeholder="CPF - Agente">
            @if ($errors->has('cpf'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="nome">Data de Nascimento:</label>
            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                placeholder="Data de Nascimento" value="{{$agente ? $agente->dataNascimento : ''}}">
            @if ($errors->has('dataNascimento'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->has('dataNascimento') ? $errors->first('dataNascimento') : '' }}
                </div>
            @endif
        </div>


        <div class="form-group">
            <label for="nome">Código Agente:</label>
            <input type="number" class="form-control" id="codigo_agente" name="codigo_agente" placeholder="Código Agente"
                value="{{$agente ? $agente->codigo_agente : ''}}">
            @if ($errors->has('codigo_agente'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->has('codigo_agente') ? $errors->first('codigo_agente') : '' }}
                </div>
            @endif
        </div>



        <div class="form-group">
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-control" name="sexo" id="sexo" required>
                    <option>Selecione o sexo...</option>
                    <option value="Masculino" {{$agente && $agente->sexo === 'Masculino' ? 'selected' : ''}}>Masculino</option>
                    <option value="Feminino" {{$agente && $agente->sexo === 'Feminino' ? 'selected' : ''}}>Feminino</option>
                </select>
            </div>
            @if ($errors->has('sexo'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->has('sexo') ? $errors->first('sexo') : '' }}
                </div>
            @endif
        </div>

        <input type="submit" class="btn btn-primary" onclick="return confirm('Confirme se deseja Atualizar os dados!')"
            value="Atualizar Dados Agente">
        </form>
    </div>
@endsection
