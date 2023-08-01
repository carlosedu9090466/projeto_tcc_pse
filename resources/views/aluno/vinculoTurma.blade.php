@extends('layouts.menuEscolar')

@section('title', 'Vincular Aluno')

@section('content')

    <div id="doenca-create-container" class="col-md-8 offset-md-2">
        <h3 class="text-center">Associar Alunos na turma</h3>
        <form action="" method="GET">
            {{-- @csrf --}}
            <div class="form-group">
                <label for="doenca">Selecione a Turma:</label>
                <select class="form-control" id="id_turma" name="id_turma" onchange="this.form.submit()" required>
                    <option value="0">-- Selecione uma turma</option>
                    @foreach ($turmas as $turma)
                        <option value="{{ $turma->id }}" <?php echo isset($_GET['id_turma']) && $_GET['id_turma'] == $turma['id'] ? 'selected' : ''; ?>>
                            {{ "$turma->tipo_ensino - $turma->serie - $turma->sala" }}
                        </option>
                    @endforeach
                </select>
                {{-- <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary" disabled>SELECIONAR</button>
                    <button type="button" class="btn btn-default btn-back">Voltar</button>
                </div> --}}

                @if ($errors->has('id_turma'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->has('id_turma') ? $errors->first('id_turma') : '' }}
                    </div>
                @endif

            </div>

        </form>

        @if (isset($alunos) && sizeof($alunos) > 0 && isset($_GET['id_turma']))
            <form class="submit-wait" action="/associarAluno" method="POST">
                @csrf
                <input type="hidden" name="id_turma" id="id_turma" value="{{ $_GET['id_turma'] }}">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>

                            <th width="10"></th>
                            <th width="80" class="small">ID</th>
                            <th>Nome do estudante</th>
                            <th>Filiação</th>
                            <th width="10">Nascimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos as $aluno) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id_aluno[]" id="id_aluno_{{ $aluno->id }}"
                                    value="{{ $aluno->id }}" style="width:20px; height:20px">
                            </td>
                            <td><label for="id_aluno_{{ $aluno->id }}">{{ $aluno->id }}</label></td>
                            <td><label for="id_aluno_{{ $aluno->id }}">{{ $aluno->nome }}</label></td>
                            <td>
                                <table class="table table-condensed" style="font-size:11px; margin: 0;">
                                    <tr>
                                        <th width="20">Mãe</th>
                                        <td>{{ $aluno->nome_mae }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pai</th>
                                        <td>{{ $aluno->nome_pai }}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($aluno->dataNascimento)) }}
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <th class="text-right">Total</th>
                            <td colspan="6"><?php echo sizeof($alunos); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary btn-submit-wait">ASSOCIAR ESTUDANTES</button>
                    <button type="button" class="btn btn-default btn-back pull-right">Voltar</button>
                </div>
            </form>
        @endif

    </div>

@endsection
