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
                                <input type="text" class="form-control" readonly
                                    value="{{ $userName = Auth::user()->name }}">
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
                                <input type="text" class="form-control" readonly
                                    value="{{ $userName = Auth::user()->email }}">
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

                    @if (!$UserEscolaVinculos)
                        <p>Esse Usuário Escolar não possui vinculo com nenhuma Escola!</p>
                    @else
                        <table class="table table-striped">
                            <thead>
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
                                @foreach ($UserEscolaVinculos->UserEscolarVinculo as $userVinculo)
                                    <tr>
                                        <td scropt="row">{{ $loop->index + 1 }}</td>
                                        <td>{{ $userVinculo->inep }}</td>
                                        <td>{{ $userVinculo->nome }}</td>
                                        <td>{{ $userVinculo->rural }}</td>
                                        <td>{{ $userVinculo->localidade_id }}</td>
                                        {{-- editar e excluir --}}
                                        <td>
                                            <!-- Button trigger modal -->
                                            {{-- <a href="/userEscolar/deletar/{{ $userEscolar->id }}&{{ $userVinculo->id }}"
                                                class="btn btn-danger edit-btn">
                                                <ion-icon name="trash-outline"></ion-icon>
                                                Deletar
                                            </a> --}}
                                            <form
                                                action="/userEscolar/deletar/{{ $userEscolar->id }}&{{ $userVinculo->id }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
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


    </div>

@endsection
