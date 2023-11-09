@extends('layouts.main')

@section('title', 'Edite a escola')

{{-- conteudos dessa pagina --}}
@section('content')

<div id="doenca-create-container" class="col-md-6 offset-md-3">
    <h1>Edite a escola</h1>

    <div class="container-edite">

    <form class="was-validated" action="/escola/update/{{ $escola->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationServer01">Nome da escola</label>
                <input type="text" class="form-control is-valid" name="nome" id="validationServer01" aria-describedby="validationServer01"  value="{{$escola->nome}}" required>
                <div id="validationServer01" class="invalid-feedback">
                Forneça o nome da escola!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationServer02">Inep</label>
                <input type="text" class="form-control is-valid" id="validationServer02" name="inep" aria-describedby="validationServer02"  value="{{$escola->inep}}" required>
                <div id="validationServer02" class="invalid-feedback">
                    Forneça o Inep da escola!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="validationServer03">Rua</label>
                <input type="text" class="form-control is-valid" id="validationServer03" value="{{$escola->rua}}" name="rua" aria-describedby="validationServer03" required>
                <div id="validationServer03" class="invalid-feedback">
                Forneça uma Rua válida.
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationServer03">Bairro</label>
                <input type="text" class="form-control is-valid" id="validationServer03" value="{{$escola->bairro}}" name="bairro" aria-describedby="validationServer03Feedback" required>
                <div id="validationServer03Feedback" class="invalid-feedback">
                Forneça um Bairro válido.
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationServer04">Localidade</label>
                <select class="custom-select is-valid" id="validationServer04" name="localidade_id" aria-describedby="validationServer04Feedback" required>
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
                <input type="number" class="form-control is-valid" id="validationServer05"  name="numero" value="{{$escola->numero}}" aria-describedby="validationServer05Feedback" required>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    Forneça um número válido
                </div>
            </div>
        </div>
        <!-- <div class="form-group">
            <div class="form-check">
                <input class="form-check-input is-valid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
                <label class="form-check-label" for="invalidCheck3">
                    Concorde com os termos e condições
                </label>
                <div id="invalidCheck3Feedback" class="invalid-feedback">    
                Você deve concordar antes de enviar.
                </div>
            </div>
        </div> -->
        <button class="btn btn-primary" type="submit">Atualizar escola</button>
    </form>


    </div>

</div>

@endsection