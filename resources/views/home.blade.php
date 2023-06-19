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
        @if (count($escola) > 0)
            <a href="/question/create">
                Cadastrar Escola
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
        @else
            <p>Há não Escolas no banco de dados,
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Cadastrar Escola
                    <ion-icon class="ions" name="school-outline"></ion-icon>
                </a>
            </p>
        @endif

        @if (count($escola) == 0 && $search)
            <p>Não foi possível encontrar nenhuma escola com {{ $search }}!
                <a href="/">Ver todos as escolas cadastradas!</a>
            </p>
        @elseif(count($escola) == 0)
            <p></p>
        @endif

        <!-- Modal -->
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



                        <form action="/escola" method="POST">
                            @csrf
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nome">Nome:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nome da Escola">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-auto">
                                        <div class="form-group">
                                            <label for="inep">inep:</label>
                                            <input type="text" class="form-control" id="inep" name="inep"
                                                placeholder="Digite o inep">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mr-auto">
                                        <div class="form-group">
                                            <label for="rua">rua:</label>
                                            <input type="text" class="form-control" id="rua" name="rua"
                                                placeholder="Digite o nome da rua">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">bairro:</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                placeholder="Digite o bairro da escola">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">numero:</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                                placeholder="Digite o número da escola">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mr-auto">
                                        <div class="form-group">
                                            <label for="bairro">cep:</label>
                                            <input type="text" class="form-control" id="cep" name="cep"
                                                placeholder="Digite o cep do endereço">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-auto">
                                        <div class="form-group">
                                            <label for="bairro">telefone:</label>
                                            <input type="text" class="form-control" id="telefone" name="telefone"
                                                placeholder="Digite o telefone da escola">
                                        </div>
                                    </div>

                                    <div class="col-md-4 ml-md-auto">
                                        <div class="form-group">
                                            <label for="bairro">Rural:</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                placeholder="Digite o bairro da escola">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="doenca">localidade:</label>
                                                <select class="form-control" id="doenca_id" name="doenca_id">
                                                    <option value="0">-- Selecione a localidade</option>
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
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>


                    </div>
                </div>
            </div>

        </div>







    @endsection
