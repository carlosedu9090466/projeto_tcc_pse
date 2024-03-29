@extends('layouts.menuReponsavel')

@section('title', 'Atualizar dados')


@section('content')


    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Atualização cadastral</h1>
        @isset($responsavel)
            <form action="/responsavel/update/{{ $responsavel->id }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="user_id" value="{{ $responsavel->user_id }}">
            @else
                <form action="/responsavel" method="POST">
                    @csrf
                    @endif

                    <div class="form-group">
                        <label for="nome">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
                            value="{{ $responsavel ? $responsavel->cpf : '' }}" placeholder="CPF - Responsavel">
                        @if ($errors->has('cpf'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="nome">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                            placeholder="Data de Nascimento" value="{{ $responsavel ? $responsavel->dataNascimento : '' }}">
                        @if ($errors->has('dataNascimento'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->has('dataNascimento') ? $errors->first('dataNascimento') : '' }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" name="sexo" id="sexo">
                                <option>Selecione o seu gênero</option>
                                @foreach ($sexos as $sexo)
                                    <option value="{{ $sexo->sexo }}"
                                        {{ $responsavel && $responsavel->sexo == $sexo->sexo ? 'selected' : '' }}>
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
                            <select class="form-control" name="genero" id="genero" required>
                                <option>Selecione o seu gênero</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->genero }}"
                                        {{ $responsavel && $responsavel->genero == $genero->genero ? 'selected' : '' }}>
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




                    <input type="submit" class="btn btn-primary"
                        onclick="return confirm('O CPF do responsável deve ser igual aquele que foi cadastrado na ficha do aluno!')"
                        value="Atualizar Dados responsavel">
                </form>
        </div>

    @endsection
