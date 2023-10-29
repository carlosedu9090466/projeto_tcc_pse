@extends('layouts.main')

@section('title', 'PSE - Vinculos')

@section('content')

    <div class="col-md-8 offset-md-1 mt-3">
        <h3 class="text-center mb-3">Vincular Agente nas Escolas</h3>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form>
                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $agente->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">CPF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $agente->cpf }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $agente->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly
                                    value="{{ $ativo = $agente->status_conta == 1 ? 'Ativo' : 'Inativo' }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <form action="/agenteEscolar/vinculo" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="escola">Escola:</label>
                            <input type="hidden" class="form-control" id="agenteEscolar" name="agenteEscolar"
                                value="{{ $agente->id }}">
                            <input type="hidden" class="form-control" id="agenteAtivo" name="agenteAtivo" value="1">
                            <input type="hidden" class="form-control" id="UserAgenteID" name="UserAgenteID"
                                value="{{ $agente->idUser }}">
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

                    @if ($agentesVinculados->UserAgenteVinculo->count() == 0)
                        <p>Esse Usuário Escolar não possui vinculo com nenhuma Escola!</p>
                    @else
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">INEP</th>
                                    <th scope="col">Escola</th>
                                    <th scope="col">Rural</th>
                                    <th scope="col">Localidade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($agentesVinculados->UserAgenteVinculo as $agenteVinculo)
                                    <tr>
                                        <td scropt="row">{{ $loop->index + 1 }}</td>
                                        <td>{{ $agenteVinculo->inep }}</td>
                                        <td>{{ $agenteVinculo->nome }}</td>
                                        <td>{{ $agenteVinculo->rural }}</td>
                                        <td>{{ $agenteVinculo->localidade_id }}</td>
                                        <td>
                                            <form
                                                action="/agenteEscolar/deletar/{{ $agente->id }}&{{ $agenteVinculo->id }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Tem Certeza? clique OK para confirmar!')">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                    Deletar
                                                </button>
                                            </form>
                                        </td>
                                        {{-- end --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif

                </div>
            </div>


        </div>

    @endsection
