@extends('layouts.main')

@section('title', 'Agentes de saúde - Vinculos')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Agentes de Saúde</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-userEscolar-container">
        @if (count($agentes) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Código Agente</th>
                        <th scope="col">email</th>
                        <th scope="col">Status Conta</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($agentes as $agente)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $agente->cpf }}</td>
                            <td>{{ $agente->name }}</td>
                            <td>{{ $agente->codigo_agente }}</td>
                            <td>{{ $agente->email }}</td>
                            <td>{{ $status = $agente->status_conta == 1 ? 'Ativo' : 'Desativado' }}</td>
                            {{-- editar e excluir --}}
                            <td>
                                {{-- Escolas vinculadas --}}
                                <a href="/agente/vincularEscola/{{ $agente->id }}" class="btn btn-primary">
                                    <ion-icon name="caret-down-circle-outline"></ion-icon>
                                    Vinculo Escolar
                                </a>
                                {{-- END --}}
                                <form action="/userEscolar/deletar/{{ $agente->id }}" method="POST">
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
