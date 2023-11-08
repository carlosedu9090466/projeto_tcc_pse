@extends('layouts.menuAgente')

@section('title', 'Turma Aluno')

@section('content')


    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h4>Resposta - Questionário do {{ $aluno->nome }}</h4>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-turmas-container">
        @if (count($alunoResposta) > 0)
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#staticBackdrop">
                Observações do aluno
            </button>

            <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#staticBackdrop2">
                Cadastrar IMC
            </button>

            <button class="btn btn-warning mb-2" onclick="history.back()">Voltar</button>
           
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doença</th>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Resposta</th>
                        <th scope="col">Data Resposta</th>
                        {{-- <th scope="col">Ações</th> --}}
                    </tr>
                </thead>

                <tbody>

                    @foreach ($alunoResposta as $resp)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $resp->doenca }}</td>
                            <td>{{ $resp->pergunta }}</td>
                            <td>{{ $resp->resposta }}</td>
                            <td>{{ date('d/m/Y', strtotime($resp->data_resposta)) }}</td>
                            {{-- <td>
                                <a href="/agente/acompanhamento/{{ $resp->id_pergunta_quiz }}"
                                    class="btn btn-info edit-btn">
                                    <ion-icon name="bandage-outline"></ion-icon>
                                    Visualizar Questionário
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- Modal Observações -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Acompanhamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="/acompanhamento" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="date">Data do acompanhamento</label>
                                                <input type="date" class="form-control" id="dia_observado"
                                                    name="dia_observado">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Observação do dia</label>
                                                <textarea class="form-control" name="observacao"
                                                    style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;" autofocus
                                                    id="exampleFormControlTextarea1">
                                                </textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="acompanhamento">Status do Acompanhamento</label>
                                                <select class="form-control" id="status_acompanhamento"
                                                    name="status_acompanhamento">
                                                    <option value="0">-- Selecione --</option>
                                                    <option value="Em andamento">Em andamento</option>
                                                    <option value="Finalizado">Finalizado</option>
                                                </select>

                                                @if ($errors->has('status_acompanhamento'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $errors->has('status_acompanhamento') ? $errors->first('status_acompanhamento') : '' }}
                                                    </div>
                                                @endif

                                            </div>

                                            <input type="hidden" id="id_aluno" name="id_aluno"
                                                value="{{ $aluno->id }}">
                                            <input type="hidden" name="id_agente" id="id_agente"
                                                value="{{ $agente->id }}">

                                            <input type="hidden" name="id_turma" id="id_turma"
                                                value="{{ $turma->id }}">

                                    </div>
                                </div>
                                <hr>

                                @if ($observacao->count() == 0)
                                    <p>Não há acompanhamento para esse aluno!</p>
                                @else
                                    <div class="row">
                                        @foreach ($observacao as $obs)
                                            <div class="col-md-4 mb-3">
                                                <div class="card" style="width: 14rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            {{ $obs->status_acompanhamento }}
                                                        </h5>
                                                        <p class="card-text">{{ $obs->observacao }}</p>
                                                        <p class="card-text">
                                                            {{ date('d/m/Y', strtotime($obs->dia_observado)) }}
                                                        </p>
                                                        {{-- <a href="#" class="card-link">Card link</a>
                                                        <a href="#" class="card-link">Another link</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal IMC -->
            <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">IMC - Aluno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="/imc" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="peso">Peso:</label>
                                                <input type="text" class="form-control" id="peso" name="peso"
                                                    placeholder="peso em kg">
                                                @if ($errors->has('peso'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $errors->has('peso') ? $errors->first('peso') : '' }}
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="altura">Altura:</label>
                                                <input type="text" class="form-control" id="altura" name="altura"
                                                    placeholder="Altura em metros">
                                                @if ($errors->has('altura'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $errors->has('altura') ? $errors->first('altura') : '' }}
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="date">Data do registro</label>
                                                <input type="date" class="form-control" id="dia_registrado"
                                                    name="dia_registrado">
                                            </div>

                                            <input type="hidden" id="id_aluno" name="id_aluno"
                                                value="{{ $aluno->id }}">
                                            <input type="hidden" name="id_agente" id="id_agente"
                                                value="{{ $agente->id }}">

                                            <input type="hidden" name="id_turma" id="id_turma"
                                                value="{{ $turma->id }}">

                                    </div>
                                </div>
                                <hr>

                                @if ($imc->count() == 0)
                                    <p>O aluno não possui o seu IMC cadastrado!</p>
                                @else
                                    <div class="row">
                                        @foreach ($imc as $im)
                                            <div class="col-md-4 mb-3">
                                                <div class="card" style="width: 14rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            Grau: {{ $im->grau_imc }}
                                                        </h5>
                                                        <p class="card-text">IMC: {{ $im->imc }}</p>
                                                        <p class="card-text">Altura: {{ $im->altura }} m</p>
                                                        <p class="card-text">Peso: {{ $im->peso }} kg</p>
                                                        <p class="card-text"> dia registrado:
                                                            {{ date('d/m/Y', strtotime($im->dia_acompanhado)) }}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
@else
    <p>Não há Respostas desse aluno!</p>
    @endif
    </div>

@endsection
