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
                    @foreach ($quizs as $quiz)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <form id="form_quiz" action="" method="POST">
                                <td>{{ $quiz->pergunta }}</td>
                                <td>{{ $quiz->nome }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">
                                            SIM
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="exampleRadios2" value="option2" checked>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Não
                                        </label>
                                    </div>
                                </td>

                        </tr>

                        </form>
                    @endforeach
                    <button form="form_quiz" class="btn btn-primary mb-2">Enviar</button>
                </tbody>
            </table>
        @else
            <p>Há não Questionário disponível, <a href="/responsavel/home">Voltar</a></p>
        @endif
    </div>

@endsection
