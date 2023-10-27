@extends('layouts.mainLogin')

@section('content')
<div class="container">
    <div class="content second-content">
        <div class="first-column">
            <img src="/img/pse_logo.png" alt="Logo PSE" width="150px">
            <h2 class="title title-primary">Sistema PSE!</h2>
            <p class="description description-primary">Entre de acordo com a sua permissão</p>
            <p class="description description-primary">Admistrador - Agente de Saúde - Usuário Escolar - Aluno</p>

            <a class="btn btn-primary" href="{{ route('register') }}">Criar</a>
        </div>

        <div class="second-column">
            <h2 class="title title-second">Bem Vindo</h2>
            <div class="social-media">
                {{-- <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul> --}}
            </div><!-- social media -->
            <p class="description description-second">Acesse com seu E-mail cadastrado:</p>
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <label class="label-input" for="">
                <ion-icon name="person-circle-outline"></ion-icon>
                    {{-- <input type="email" placeholder="E-mail"> --}}
                    <input id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
                </label>
                

                <label class="label-input" for="">
                    <i class="fas fa-lock icon-modify"></i>
                    <input id="password" type="password" @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="current-password">
                </label>
                @error('password')
               
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror

                {{-- <input type="checkbox" id="mostrar" onclick="mostrarDivEscola()"> --}}
                <label class="label-input" id="mostrar" onclick="mostrarDivEscola()" for="">Usuário Escolar ?
                </label>

                {{-- <input class="label-input" onclick="mostrarDivEscola()" type="checkbox" id="mostrar">Usuário
                    Escolar? --}}

                {{-- <label class="label-input" for="mostrar">
                                Usuário Escolar
                            </label> --}}

                <div id="divEscola" class="form-group row" style="display:none">
                    <label for="escola" class="col-md-4 col-form-label text-md-right">{{ __('Escola') }}</label>

                    <div class="col-md-6">
                        <select class="form-control" id="escola_id" name="escola_id" required>
                            <option value="0">Selecione a Escola</option>
                            @foreach ($escolas as $escola)
                            <option value="{{ $escola->id }}">
                                {{ $escola->nome }}
                            </option>
                            @endforeach
                        </select>

                        @error('escola_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                @if (Route::has('password.request'))
                <a class="password" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
                @endif
                {{-- <a class="password" href="#">Esqueceu a senha?</a> --}}
                <button class="btn btn-second">Logar</button>
            </form>
        </div><!-- second column -->
    </div><!-- second-content -->
</div>
@endsection