@extends('layouts.menuAgente')

@section('title', 'Atualizando Dados Cadastrais')

@section('content')
    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastra Dados Agente</h1>
        <form action="/agenteDados" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
                    placeholder="CPF - Agente">
                @if ($errors->has('cpf'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="nome">Código Agente:</label>
                <input type="number" class="form-control" id="codigo_agente" name="codigo_agente"
                    placeholder="Código Agente">
                @if ($errors->has('codigo_agente'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('codigo_agente') ? $errors->first('codigo_agente') : '' }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label for="nome">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                    placeholder="Data de Nascimento">
                @if ($errors->has('dataNascimento'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('dataNascimento') ? $errors->first('dataNascimento') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" id="sexo" required>
                        <option>Selecione o sexo...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
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
