@extends('layouts.main')

@section('title', 'PSE')

{{-- conteudos dessa pagina --}}
@section('content')
    {{-- id="container-fluid search-container" class="col-md-8" --}}
    <div class="col-md-10 offset-md-1 dashboard-doencas-container">
        <h1>Escolas</h1>

        <form action="/" method="GET" class="float-md-right">
            <input type="text" id="search" name="search" class="form-control" placeholder="Pesquise uma Escola">
        </form>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-doencas-container">
        @if (count($escolas) > 0)
            <a type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
                Cadastrar Escola
                <ion-icon class="ions" name="school-outline"></ion-icon>
            </a>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Inep</th>
                        <th scope="col">Escola</th>
                        <th scope="col">Rua</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Localidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($escolas as $escola)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $escola->inep }}</td>
                            <td>{{ $escola->nome }}</td>
                            <td>{{ $escola->rua }}</td>
                            <td>{{ $escola->bairro }}</td>
                            <td>{{ $escola->EscolaMunicipioOne->nome }}</td>
                            {{-- editar e excluir --}}
                            <td>
                                <a href="/doenca/edit/{{ $escola->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#staticBackdrop1">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button> --}}
                                <form action="/escola/{{ $escola->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
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
        @else
            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                Cadastrar Escola
                <ion-icon class="ions" name="school-outline"></ion-icon>
            </a>

        @endif

        @if (count($escolas) == 0 && $search)
            <p>Não foi possível encontrar nenhuma escola com {{ $search }}!
                <a href="/">Ver todos as escolas cadastradas!</a>
            </p>
        @elseif(count($escolas) == 0)
            <p></p>
        @endif

        <!-- Modal de criação da escola -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adicionar Escola</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="/escola" method="post">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nome">Nome:</label>
                                            <input type="text" class="form-control" id="name" name="nome"
                                                placeholder="Nome da Escola" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-auto">
                                        <div class="form-group">
                                            <label for="inep">Inep:</label>
                                            <input type="text" class="form-control" id="inep" name="inep"
                                                placeholder="Digite o inep" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mr-auto">
                                        <div class="form-group">
                                            <label for="rua">Rua:</label>
                                            <input type="text" class="form-control" id="rua" name="rua"
                                                placeholder="Digite o nome da rua" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">Bairro:</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                placeholder="Digite o bairro da escola" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">Numero:</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                                placeholder="Digite o número da escola">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mr-auto">
                                        <div class="form-group">
                                            <label for="bairro">Cep:</label>
                                            <input type="text" class="form-control" id="cep" name="cep"
                                                placeholder="Digite o cep do endereço">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-auto">
                                        <div class="form-group">
                                            <label for="bairro">Telefone:</label>
                                            <input type="text" class="form-control" id="telefone" name="telefone"
                                                placeholder="Digite o telefone da escola">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">Zona:</label>
                                            <select class="form-control" name="zona" id="zona" required>
                                                <option>Selecione a zona...</option>
                                                <option value="0">Urbana</option>
                                                <option value="1">Rural</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="doenca">Localidade:</label>
                                                <select class="form-control" id="localidade_id" name="localidade_id"
                                                    required>
                                                    <option>Selecione a localidade...</option>
                                                    @foreach ($municipios as $municipio)
                                                        <option value="{{ $municipio->id }}">
                                                            {{ $municipio->nome }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                {{-- <button type="submit" class="btn btn-primary">Salvar</button> --}}
                                <input type="submit" class="btn btn-primary" value="Salvar">
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        {{-- END modal de criação --}}

    @endsection
