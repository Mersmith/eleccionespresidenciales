<div class="encuesta-contenedor">
    <h1 class="titulo">{{ $encuesta->nombre }}</h1>
    <p class="descripcion">{{ $encuesta->descripcion }}</p>

    @php
        $totalVotos = $resultados->sum('votos');
    @endphp

    <p class="total-votos">Total de votos: <strong>{{ $totalVotos }}</strong></p>

    @foreach ($resultados as $item)
        @php
            $porcentaje = $totalVotos > 0 ? round(($item['votos'] / $totalVotos) * 100, 2) : 0;
        @endphp
        <div class="candidato-item">
            <div class="foto-contenedor">
                <img src="{{ $item['candidato_foto'] }}" alt="Candidato" class="foto-candidato">
                <img src="{{ $item['partido_foto'] }}" alt="Partido" class="logo-partido">
            </div>
            <div class="info-candidato">
                <div class="nombre-candidato">{{ $item['candidato_nombre'] }}</div>
                <div class="nombre-partido">{{ $item['partido_nombre'] }}</div>
                <div class="barra-voto">
                    <div class="barra-progreso" style="width: {{ $porcentaje }}%"></div>
                </div>
            </div>
            <div class="votos-dato">
                <div class="cantidad-votos">{{ $item['votos'] }} votos</div>
                <div class="porcentaje">{{ $porcentaje }}%</div>
            </div>
        </div>
    @endforeach


    <canvas id="barChartVertical" height="400"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('barChartVertical').getContext('2d');

            const labels = {!! json_encode(array_slice(array_column($resultados->toArray(), 'candidato_nombre'), 0, 5)) !!};
            const data = {!! json_encode(array_slice(array_column($resultados->toArray(), 'votos'), 0, 5)) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de Votos',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'x', // barras verticales (por defecto)
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Votos'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Candidatos'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <canvas id="pieChart" height="400"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pieChart').getContext('2d');

            const labels = {!! json_encode(array_slice(array_column($resultados->toArray(), 'candidato_nombre'), 0, 5)) !!};
            const data = {!! json_encode(array_slice(array_column($resultados->toArray(), 'votos'), 0, 5)) !!};

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de Votos',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>

</div>
