@extends('layouts.menuEscolar')

@section('title', 'Aluno - Individual')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 dashboard-title-container d-flex flex-row">
                <h4>Alunos - {{ $escola->nome }}</h4>
            </div>
            <div class="col-6 col-md-4 dashboard-title-container">
                <form action="/alunos/visualiza/{{ $escola->id }}/" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" id="pesq" name="pesq"
                        placeholder="Pesquisar aluno" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
    </div>



    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($alunos) > 0)

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="teste">ID aluno</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">CPF ALuno</th>
                        <th scope="col">Filiação I</th>
                        <th scope="col">Filiação II</th>
                        <th scope="col">CPF Responsável</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($alunos as $aluno)
                        <tr>
                            <td scropt="row" class="teste">{{ $aluno->id }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ date('d/m/Y', strtotime($aluno->dataNascimento)) }}</td>
                            <td>{{ $aluno->cpf_aluno }}</td>
                            <td>{{ $aluno->nome_pai }}</td>
                            <td>{{ $aluno->nome_mae }}</td>
                            <td>{{ $aluno->cpf_responsavel }}</td>

                            <td>
                                <a href="/aluno/edit/{{ $aluno->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                <!-- Button trigger modal -->
                                <form action="/alunos/{{ $aluno->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Confirma excluir a turma?')">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há turmas criadas nesse período, <a href="/turmas/create/{{ $escola->id }}">Criar Turmas</a></p>
        @endif
    </div>

@endsection
