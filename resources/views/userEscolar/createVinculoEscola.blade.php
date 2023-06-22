@extends('layouts.main')

@section('title', 'PSE - Vinculos')
{{-- DEPOIS ADICIONAR OS CARDS, pois terá as IMAGENS em cada doença --}}
{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-8 offset-md-1 mt-3">

        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form>
                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $userEscolar->nome }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">CPF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $userEscolar->cpf }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $userEscolar->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly
                                    value="{{ $ativo = $userEscolar->ativo_user == 1 ? 'Ativo' : 'Inativo' }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <form action="/userEscolar/vinculo" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="escola">Escola:</label>
                            <input type="hidden" class="form-control" id="userEscolar" name="userEscolar"
                                value="{{ $userEscolar->id }}">
                            <input type="hidden" class="form-control" id="userAtivo" name="userAtivo" value="1">
                            <select class="form-control" id="escola_id" name="escola_id" required>
                                <option>Selecione a escola...</option>
                                @foreach ($escolas as $escola)
                                    <option value="{{ $escola->id }}">
                                        {{ $escola->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Vincular">
                    </form>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <table>vinculos do User</table>
                </div>
            </div>
        </div>


    </div>

@endsection
