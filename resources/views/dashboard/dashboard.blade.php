@extends('layouts.main')

@section('title', 'PSE - Dashboard')
@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Relatórios Gerais</h1>
    </div>


    <div class="col-md-6 offset-md-1 dashboard-doencas-container">
        <canvas id="myChart" width="50"></canvas>
    </div>
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




    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($alunoGenero) !!},
                datasets: [{
                    label: 'Sexo/generos',
                    data: {!! json_encode($totalGenero) !!},
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
    </script>

@endsection
