@extends('layouts.main')

@section('title', 'Edite a pergunta {{ $question->doenca->nome }}')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Edite a pergunta</h1>
        <form action="/question/update/{{ $question->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Enfermidade:</label>
                <input type="text" class="form-control" id="doenca_id" name="doenca_id"
                    value="{{ $question->doencas->nome }}" minlength="3" maxlength="50" placeholder="Enfermidade" disabled>

                @if ($errors->has('doenca_id'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('doenca_id') ? $errors->first('doenca_id') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="nome">Digite a pergunta:</label>
                <input type="text" class="form-control" id="pergunta" name="pergunta" value="{{ $question->pergunta }}"
                    minlength="5" maxlength="100" placeholder="?Digite a pergunta?">

                @if ($errors->has('pergunta'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('pergunta') ? $errors->first('pergunta') : '' }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label class="form-check-label">Pergunta é discursiva ? </label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="discursiva" value="1"
                        class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Sim</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="discursiva" value="0"
                        class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Não</label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Editar Pergunta">
        </form>
    </div>

@endsection
