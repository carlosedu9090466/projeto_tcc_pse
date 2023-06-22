@extends('layouts.main')

@section('title', 'PSE - Dashoard')
{{-- DEPOIS ADICIONAR OS CARDS, pois terá as IMAGENS em cada doença --}}
{{-- conteudos dessa pagina --}}
@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Controle de efermidades</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-doencas-container">
        @if (count($doencas) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sintomas</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($doencas as $doenca)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $doenca->nome }}</td>
                            <td>{{ $doenca->sintomas }}</td>
                            {{-- editar e excluir --}}
                            <td>
                                <a href="/doenca/edit/{{ $doenca->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#staticBackdrop">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button> --}}
                                <a href="/doenca/deletar/{{ $doenca->id }}" class="btn btn-danger edit-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </a>
                            </td>
                            {{-- end --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- modal para delete --}}
            {{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Deletar a doença: {{ $doenca->nome }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>
                                Caso faça a operação de deletar o dado. Todos as perguntas vinculadas a {{ $doenca->nome }}
                                serão deletadas!
                            </h4>
                        </div>
                        <form action="/doenca/{{ $doenca->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            {{-- end - Modal --}}
        @else
            <p>Há não registro de doenças no banco de dados, <a href="/doenca/create">Inserir doença</a></p>
        @endif
    </div>

@endsection
