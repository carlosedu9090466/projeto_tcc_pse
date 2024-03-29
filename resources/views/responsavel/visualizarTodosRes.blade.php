@extends('layouts.main')

@section('title', 'Responsáveis - Cadastrados')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Responsáveis cadastrados</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-userEscolar-container">
        @if (count($responsaveis) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">email</th>
                        <!-- <th scope="col">Status Conta</th> -->
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($responsaveis as $responsavel)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>

                            <td>{{ $responsavel->name }}</td>

                            <td>{{ $responsavel->email }}</td>

                            {{-- editar e excluir --}}
                            <td>
                                {{-- Escolas vinculadas --}}
                                <!-- <a href="/agente/vincularEscola/{{ $responsavel->id }}" class="btn btn-primary">
                                        <ion-icon name="caret-down-circle-outline"></ion-icon>
                                        Visualizar Aluno
                                    </a> -->
                                {{-- END --}}
                                <form action="/responsavel/deletar/{{ $responsavel->id }}" method="POST">
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
        @else
            <p>Não Há Agentes Escolares cadastrados!, <a href="/userEscolar/create">Inserir Usuário</a></p>
        @endif
    </div>
@endsection
