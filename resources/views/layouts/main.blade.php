<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- mudar dinamicamente --}}
    <title>@yield('title')</title>
    {{-- fonte do google --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Poppins:wght@400;600&family=Roboto:wght@100;400;700;900&display=swap"
        rel="stylesheet">

    {{-- CSS bootsrapt --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- JS Bootsrapt --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>


</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="" class="navbar-brand">
                    {{-- Logo do projeto --}}
                    <img src="" alt="PSE">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Controle Doenças
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/doenca/create">Registrar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/doenca/home">Visualizar</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Questionarios
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/question/home">Perguntas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/quiz/home">Visualizar Quiz</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>

                    <li>
                        <a href="/escola/home" class="nav-link">Escolas do programa</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Usuários
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/agente/create">Cadastrar Usuários</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/agente/createVinculo">Visualizar Agentes de Saúde</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/userEscolar/home">Visualizar Usuários Escolares</a>
                            <div class="dropdown-divider"></div>
                        </div>

                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar Usuário') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Auth::user()->role_id == 2)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Escolas Vinculas
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li>
                                <a href="/turmas/home" class="nav-link">Turmas</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                {{-- if com a mensagem vindo do controller. --}}
                @if (session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                {{-- Mensagem erro --}}
                @if (session('error'))
                    <p class="error">{{ session('error') }}</p>
                @endif
                {{-- mudar dinamicamente --}}
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <p>PSE - Programa sáude na escola &copy; 2023</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
