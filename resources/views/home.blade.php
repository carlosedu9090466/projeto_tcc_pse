@extends('layouts.main')

@section('title', 'PSE')

{{-- conteudos dessa pagina --}}
@section('content')

    <div id="container-fluid search-container" class="col-md-8">
        <h1>Escola</h1>

        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Pesquise uma Escola">
        </form>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-doencas-container">

        @if (count($escola) == 0 && $search)
            <p>Não foi possível encontrar nenhuma escola com {{ $search }}!
                <a href="/">Ver todos as escolas cadastradas!</a>
            </p>
        @elseif(count($escola) == 0)
            <p></p>
        @endif

    </div>







@endsection
