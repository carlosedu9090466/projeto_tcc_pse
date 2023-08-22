@extends('layouts.main')

@section('title', 'PSE - Ambiente Escolar')
{{-- DEPOIS ADICIONAR OS CARDS, pois terá as IMAGENS em cada doença --}}
{{-- conteudos dessa pagina --}}
@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Usuários Escolares</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-userEscolar-container">
        @if (count($userEscolar) > 0)
            {{-- <a href="/userEscolar/create" type="button" class="btn btn-primary mb-3">
                Cadastrar Usuário Escolar
                <ion-icon class="ions" name="school-outline"></ion-icon>
            </a> --}}

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        {{-- <th scope="col">CPF</th> --}}
                        <th scope="col">Nome</th>
                        <th scope="col">email</th>
                        {{-- <th scope="col">Status Conta</th> --}}
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($userEscolar as $user)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            {{-- <td>{{ $user->cpf }}</td> --}}
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            {{-- <td>{{ $status = $user->ativo_user == 1 ? 'Ativo' : 'Desativado' }}</td> --}}
                            {{-- editar e excluir --}}
                            <td>
                                {{-- Escolas vinculadas --}}
                                <a href="/userEscolar/vincularEscola/{{ $user->id }}" class="btn btn-primary">
                                    <ion-icon name="caret-down-circle-outline"></ion-icon>
                                    Vinculo Escolar
                                </a>
                                {{-- END --}}
                                <a href="/userEscolar/edit/{{ $user->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <form action="/userEscolar/deletar/{{ $user->id }}" method="POST">
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
            <p>Não Há Usuários Escolares cadastrados!, <a href="/userEscolar/create">Inserir Usuário</a></p>
        @endif
    </div>

@endsection
