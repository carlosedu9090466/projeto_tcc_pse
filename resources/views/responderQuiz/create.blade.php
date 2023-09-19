@extends('layouts.menuReponsavel')

@section('title', 'Responder - Quiz')


@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Questionario</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-doencas-container">
        @if (count($quizs) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Doença</th>
                        <th scope="col" class="text-left" colspan="2">Resposta</th>

                    </tr>
                </thead>

                <tbody>
                    <form id="form_quiz" action="/respostaQuiz" method="POST">
                        @csrf
                        {{-- {{ dd($dado_aluno) }} --}}
                        <input type="hidden" name="id_turma" id="id_turma" value="{{ $dado_aluno['id_turma'] }}">
                        <input type="hidden" name="id_aluno" id="id_aluno" value="{{ $dado_aluno['id_aluno'] }}">
                        {{-- <input type="hidden" name="cpf_responsavel" id="cpf_responsavel"
                            value="{{ $dado_aluno['cpf_responsavel'] }}"> --}}

                        @foreach ($quizs as $quiz)
                            <tr>
                                <td scropt="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $quiz->pergunta }}</td>
                                <td>{{ $quiz->nome }}</td>
                                {{-- <input type="hidden" name="id_quiz" id="quiz" value="{{ $quiz->id_quiz }}"> --}}
                                <input type="hidden" name="id_quiz_question[]" id="quiz_question"
                                    value="{{ $quiz->id_quiz_question }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="<?= "resposta[{$quiz->id_quiz_question}]" ?>" id="id_resposta"
                                        value="S">
                                        <label class="form-check-label" for="exampleRadios1">
                                            SIM
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="<?= "resposta[{$quiz->id_quiz_question}]" ?>" id="id_resposta"
                                        value="N" checked>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Não
                                        </label>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </form>

                    <div class="button-container">
                        <button form="form_quiz" class="btn btn-primary mb-2"
                            onclick="return confirm('Clique para confirmar as respostas!')">Responder</button>

                        <button class="btn btn-warning" onclick="history.back()">Voltar</button>
                    </div>
                </tbody>
            </table>
        @else
            <p>Há não Questionário disponível, <a href="/responsavel/home">Voltar</a></p>
        @endif
    </div>

@endsection
