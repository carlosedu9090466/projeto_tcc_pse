@extends('layouts.main')

@section('title', 'Cadastrar Usuário Escolar')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastrar Usuário Escolar</h1>

        <form action="/userEscolar" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome"
                    placeholder="Digite o nome do servidor">
                @if ($errors->has('nome'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o seu CPF">
                @if ($errors->has('cpf'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o seu E-mail">
                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <div class="form-group">
                    <label for="role">Permissão:</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        <option>Selecione...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->role }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('role_id'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('role_id') ? $errors->first('role_id') : '' }}
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
                        <option>Selecione o sexo...</option>
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>
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

            <input type="submit" class="btn btn-primary" value="Registrar ADM Escolar">
        </form>
    </div>

@endsection
