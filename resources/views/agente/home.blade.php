@extends('layouts.menuAgente')

@section('title', 'Home Agente')

@section('content')


    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Escolas Vinculadas</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($escolasVinculadasAgente) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Escola</th>
                        <th scope="col">Inep</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($escolasVinculadasAgente as $escolasVinculadas)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $escolasVinculadas->nome }}</td>
                            <td>{{ $escolasVinculadas->inep }}</td>
                            <td>{{ $escolasVinculadas->municipio }}</td>
                            <td>
                                <a href="/turmas/espelho/{{ $escolasVinculadas->id_escola }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Visualizar Turmas
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há Escolas Vinculadas a esse Agente de saúde!, Informe o Admistrador!</p>
        @endif
    </div>

@endsection
