@extends('layouts.menuEscolar')

@section('title', 'Matricula Individual')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="cadastro-turma-container" class="col-md-6 offset-md-3">
        <h1 id="title-cadastros">Matrícula Individual</h1>
        <form action="/alunos" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome do Aluno:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do aluno">
                @if ($errors->has('nome'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="nome">CPF do aluno:</label>
                <input type="text" class="form-control" id="cpf_aluno" name="cpf_aluno" maxlength="11"
                    placeholder="CPF - Aluno">
                @if ($errors->has('cpf_aluno'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf_aluno') ? $errors->first('cpf_aluno') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="nome">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                    placeholder="Data de Nascimento">
                @if ($errors->has('dataNascimento'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf_adataNascimentoluno') ? $errors->first('dataNascimento') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" id="sexo">
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

            <div class="form-group">
                <label for="nome">Nome do pai:</label>
                <input type="text" class="form-control" id="nome_pai" name="nome_pai" placeholder="Nome do pai">
                @if ($errors->has('nome_pai'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome_pai') ? $errors->first('nome_pai') : '' }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label for="nome">Nome da mãe:</label>
                <input type="text" class="form-control" id="nome_mae" name="nome_mae" placeholder="Nome da mãe">
                @if ($errors->has('nome_mae'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('nome_mae') ? $errors->first('nome_mae') : '' }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label for="nome">CPF do Responsável:</label>
                <input type="text" class="form-control" id="cpf_responsavel" name="cpf_responsavel" maxlength="11"
                    placeholder="CPF - resposável">
                @if ($errors->has('cpf_responsavel'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('cpf_responsavel') ? $errors->first('cpf_responsavel') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="nome">Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" placeholder="Endereço - Rua">
                @if ($errors->has('rua'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('rua') ? $errors->first('rua') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="nome">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Endereço - Bairro">
                @if ($errors->has('bairro'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('bairro') ? $errors->first('bairro') : '' }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="nome">Número:</label>
                <input type="number" class="form-control" id="numero" name="numero" placeholder="Endereço - Número">
                @if ($errors->has('numero'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('numero') ? $errors->first('numero') : '' }}
                    </div>
                @endif
            </div>



            <input type="hidden" id="escola_id" name="escola_id" value="{{ $escola->id }}">

            <input type="submit" class="btn btn-primary" value="Cadastrar Aluno">
        </form>
    </div>

@endsection
