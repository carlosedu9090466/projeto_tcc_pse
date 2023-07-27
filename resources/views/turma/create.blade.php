@extends('layouts.menuEscolar')

@section('title', 'Criação de Turmas')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastro de turmas</h1>
        <form action="/turmas" method="POST">
            @csrf
            <div class="form-group">
                <label for="doenca">Tipo de Ensino:</label>
                <select class="form-control" id="tipo_ensino" name="tipo_ensino">
                    <option value="0">-- Selecione --</option>
                    <option value="Ensino Fundamental I">Ensino Fundamental I</option>
                    <option value="Ensino Fundamental II">Ensino Fundamental II</option>
                    <option value="Ensino Medio">Ensino Médio</option>
                </select>

                @if ($errors->has('tipo_ensino'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('tipo_ensino') ? $errors->first('tipo_ensino') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="doenca">Serie:</label>
                <select class="form-control" id="serie" name="serie">
                    <option value="0">-- Selecione a serie</option>
                    @foreach ($series as $serie)
                        <option value="{{ $serie->serie }}">
                            {{ $serie->serie }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('serie'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('serie') ? $errors->first('serie') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="doenca">Turno:</label>
                <select class="form-control" id="turno" name="turno">
                    <option value="0">-- Selecione --</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Noturno">Noturno</option>
                </select>

                @if ($errors->has('turno'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('turno') ? $errors->first('turno') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="doenca">Sala:</label>
                <select class="form-control" id="sala" name="sala">
                    <option value="0">-- Selecione a sala --</option>
                    @foreach ($salas as $sala)
                        <option value="{{ $sala->sala }}">
                            {{ $sala->sala }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('sala'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('sala') ? $errors->first('sala') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="date">Vigencia Inicial Turma</label>
                    <input type="date" class="form-control" id="vigencia_inicial" name="vigencia_inicial">
                </div>

                <div class="form-group">
                    <label for="date">Vigencia Final Turma</label>
                    <input type="date" class="form-control" id="vigencia_final" name="vigencia_final">
                </div>
            </div>

            <input type="hidden" id="status_turma" name="status_turma" value="1">
            <input type="hidden" id="escola_id" name="escola_id" value="{{ $escola->id }}">

            <input type="submit" class="btn btn-primary" value="Cadastrar Turma">
        </form>
    </div>

@endsection
