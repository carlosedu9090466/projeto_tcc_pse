@extends('layouts.main')

@section('title', 'Edite a escola {{ $escola->nome }}')

{{-- conteudos dessa pagina --}}
@section('content')

<div id="doenca-create-container" class="col-md-6 offset-md-3">
    <h1>Edite a escola</h1>
    <form class="was-validated" action="/escola/update/{{ $escola->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationServer01">Nome da escola</label>
                <input type="text" class="form-control is-valid" name="nome" id="validationServer01" value="{{$escola->nome}}" required>
                <div class="valid-feedback">
                Muito bem!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationServer02">Inep</label>
                <input type="text" class="form-control is-valid" id="validationServer02" name="inep" value="{{$escola->inep}}" required>
                <div class="valid-feedback">
                    Muito bem!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="validationServer03">Rua</label>
                <input type="text" class="form-control is-invalid" id="validationServer03" value="{{$escola->rua}}" name="rua" aria-describedby="validationServer03Feedback" required>
                <div id="validationServer03Feedback" class="invalid-feedback">
                Forneça uma Rua válida.
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationServer03">Bairro</label>
                <input type="text" class="form-control is-invalid" id="validationServer03" value="{{$escola->bairro}}" name="bairro" aria-describedby="validationServer03Feedback" required>
                <div id="validationServer03Feedback" class="invalid-feedback">
                Forneça um Bairro válido.
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationServer04">Localidade</label>
                <select class="custom-select is-invalid" id="validationServer04" name="localidade_id" aria-describedby="validationServer04Feedback" required>
                    <option selected disabled value="">Municipio</option>
                    @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" {{ $municipio->id == $escola->localidade_id ? 'selected' : '' }}>
                            {{ $municipio->nome }}
                        </option>
                    @endforeach
                </select>
                <div id="validationServer04Feedback" class="invalid-feedback">
                Forneça um bairro válida.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationServer05">Número</label>
                <input type="text" class="form-control is-invalid" id="validationServer05" name="numero" aria-describedby="validationServer05Feedback" required>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    Forneça um número válido
                </div>
            </div>
        </div>
        <!-- <div class="form-group">
            <div class="form-check">
                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
                <label class="form-check-label" for="invalidCheck3">
                    Agree to terms and conditions
                </label>
                <div id="invalidCheck3Feedback" class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div> -->
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
</div>

@endsection