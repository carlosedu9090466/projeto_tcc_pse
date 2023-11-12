@extends('layouts.menuEscolar')

@section('title', 'Edite a Matricula Individual')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="doenca-create-container" class="col-md-6 offset-md-3">
        <h1>Edite os dados</h1>
        <form class="was-validated" action="/aluno/update/{{ $aluno->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationServer01">Nome do aluno:</label>
                    <input type="text" class="form-control is-valid" name="nome" id="validationServer01"
                        aria-describedby="validationServer01" value="{{ $aluno->nome }}" required>

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer03">Data de Nascimento:</label>
                    <input type="text" class="form-control is-valid" id="validationServer03"
                        value="{{ date('Y-m-d', strtotime($aluno->dataNascimento)) }}" name="dataNascimento"
                        aria-describedby="validationServer03Feedback" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer02">Filiação I:</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" name="nome_pai"
                        aria-describedby="validationServer02" value="{{ $aluno->nome_pai }}" required>

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer02">Filiação II:</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" name="nome_mae"
                        aria-describedby="validationServer02" value="{{ $aluno->nome_mae }}" required>

                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationServer03">CPF do aluno:</label>
                    <input type="text" class="form-control is-valid" id="validationServer03" maxlength="11"
                        value="{{ $aluno->cpf_aluno }}" name="cpf_aluno" aria-describedby="validationServer03" required>
                    <div id="validationServer03" class="invalid-feedback">
                        Forneça uma Rua válida.
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationServer03">CPF do Responsável</label>
                    <input type="text" class="form-control is-valid" id="validationServer03"
                        value="{{ $aluno->cpf_responsavel }}" name="cpf_responsavel"
                        aria-describedby="validationServer03Feedback" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        O CPF do Responsável deve ser igual ao que ele inseriu no seu cadastro!
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationServer04">Sexo</label>
                    <select class="custom-select is-valid" id="validationServer04" name="sexo"
                        aria-describedby="validationServer04Feedback" required>
                        <option selected disabled value="">Sexo</option>
                        @foreach ($sexos as $sexo)
                            <option value="{{ $sexo->sexo }}" {{ $sexo->sexo == $aluno->sexo ? 'selected' : '' }}>
                                {{ $sexo->sexo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationServer04">Gênero</label>
                    <select class="custom-select is-valid" id="validationServer04" name="genero"
                        aria-describedby="validationServer04Feedback" required>
                        <option selected disabled value="">Gênero</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->genero }}"
                                {{ $genero->genero == $aluno->genero ? 'selected' : '' }}>
                                {{ $genero->genero }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationServer05">Rua:</label>
                    <input type="text" class="form-control is-valid" id="validationServer05" name="rua"
                        value="{{ $aluno->rua }}" aria-describedby="validationServer05Feedback" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer05">Bairro:</label>
                    <input type="text" class="form-control is-valid" id="validationServer05" name="bairro"
                        value="{{ $aluno->bairro }}" aria-describedby="validationServer05Feedback" required>

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationServer05">Número:</label>
                    <input type="text" class="form-control is-valid" id="validationServer05" name="numero"
                        value="{{ $aluno->numero }}" aria-describedby="validationServer05Feedback" required>

                </div>
            </div>

            <input type="hidden" name="inep" value="{{ $aluno->inep }}">
            <input type="hidden" name="id_turma_aluno" value="{{ $aluno->id_turma_aluno }}">

            <input type="submit" class="btn btn-primary" value="Editar os Dados">
        </form>
    </div>


@endsection
