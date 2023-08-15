@extends('layouts.menuEscolar')

@section('title', 'Turmas')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Turma - {{ $turma->serie }}</h4>
    </div>



    <div class="col-md-10 offset-md-1 dashboard-question-container">
        @if (count($turma->turmaAluno) > 0)
            {{-- tenho que verificar como traz chamada e fazer as alterações --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Aluno</th>
                        <th scope="col">Filiação I</th>
                        <th scope="col">Filiação II</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">Situação</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($turma->turmaAluno as $aluno)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->nome_pai }}</td>
                            <td>{{ $aluno->nome_mae }}</td>
                            <td>
                                {{ date('d/m/Y', strtotime($aluno->dataNascimento)) }}
                            </td>
                            <td>MATRICULADO</td>
                            <td>
                                <form action="/alunos/{{ $aluno->id }}&{{ $turma->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Confirma excluir estudante da turma? Tem certeza?')">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Excluir
                                    </button>
                                </form>
                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                                <ion-icon name="trash-outline"></ion-icon>
                                Deletar
                            </button> --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <p>Não há alunos associados nessa turma, <a
                    href="/alunos/vinculo/{{ $escola->id }}?id_turma={{ $turma->id }}">Inserir aluno na
                    turma</a></p>
        @endif
    </div>

@endsection
