@extends('layouts.main')

@section('title', 'PSE - Dashboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Relatórios Gerais</h1>
</div>

<!-- subir códigos -->
@if (count($alunoGenero) > 0 && count($totalGenero) > 0)
<div class="col-md-6 offset-md-1 dashboard-doencas-container">
    <canvas id="myChart" width="50"></canvas>
</div>
@else

<div class="alert alert-danger col-md-6 offset-md-1" role="alert">
    <div class="d-flex align-items-center">
        <strong>Não há registro de alunos inseridos com o respectivo gênero e sexo...</strong>
        <div class="spinner-border text-primary ml-auto" role="status" aria-hidden="true"></div>
    </div>
</div>
@endif

@if(count($dadosGerais) > 0)
<div class="col-md-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Municipio</th>
                <th scope="col">Escola</th>
                <th scope="col">Total de alunos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dadosGerais as $dado)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td>{{ $dado->municipio }}</td>
                <td>{{ $dado->escola }}</td>
                <td>{{ $dado->alunos }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else

<div class="alert alert-danger col-md-4" role="alert">
    <div class="d-flex align-items-center">
        <strong>Não há registro de escolas, municipios e alunos no sistema!.</strong>
        <div class="spinner-border text-primary ml-auto" role="status" aria-hidden="true"></div>
    </div>
</div>
@endif




<script>
    if (typeof {
            !!json_encode($alunoGenero) !!
        } !== 'null' && typeof {
            !!json_encode($totalGenero) !!
        } !== 'null') {

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {
                    !!json_encode($alunoGenero) !!
                },
                datasets: [{
                    label: 'Sexo/generos',
                    data: {
                        !!json_encode($totalGenero) !!
                    },
                    backgroundColor: ['#e40303', '#ff8c00', '#ffed00', '#008026', '#004dff', '#750787'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    } else {
        console.error('Dados não disponíveis para criar o gráfico.');
    }
</script>

@endsection