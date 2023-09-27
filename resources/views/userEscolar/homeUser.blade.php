@extends('layouts.menuEscolar')

@section('title', 'Ambiente ADM Escolar')

@section('content')

    @if (count($escolaVinculos->UserEscolarVinculo) > 0 && !empty(Session::get('escola_id')))
        <p>Possui Vinculos</p>
    @else
        <p>Não possui Vinculos com nenhuma escola ou Não foi selecionado nenhuma escola no Login!</p>
    @endif

@endsection
