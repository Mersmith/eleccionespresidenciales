@section('tituloPagina', 'Reportes de Membresía')
@section('anchoPantalla', '100%')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- === KPI RESUMEN === --}}
    <div class="g_panel col-span-2">
        <h2 class="g_panel_titulo">Resumen General</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div>
                <h3 class="text-lg font-bold">{{ $resumen['total_membresias'] }}</h3>
                <p>Total Membresías</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-green-600">{{ $resumen['pagadas'] }}</h3>
                <p>Pagadas</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-red-600">{{ $resumen['no_pagadas'] }}</h3>
                <p>No Pagadas</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-blue-600">S/. {{ number_format($resumen['total_recaudado'], 2) }}</h3>
                <p>Total Recaudado</p>
            </div>
        </div>
    </div>

    {{-- === GRAFICOS POR MES === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Pagos de Membresías por Mes</h2>
        <canvas id="barChartPagos" height="120"></canvas>
    </div>

    <div class="g_panel">
        <h2 class="g_panel_titulo">Recaudación por Mes</h2>
        <canvas id="barChartRecaudacion" height="120"></canvas>
    </div>

    {{-- === GRAFICOS POR AÑO === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Pagos por Año</h2>
        <canvas id="barChartPagosAnio" height="120"></canvas>
    </div>

    <div class="g_panel">
        <h2 class="g_panel_titulo">Recaudación por Año</h2>
        <canvas id="barChartRecaudacionAnio" height="120"></canvas>
    </div>

    {{-- === RECAUDACIÓN POR TIPO === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Recaudación por Tipo</h2>
        <canvas id="doughnutTipo" height="120"></canvas>
    </div>

    {{-- === MIEMBROS QUE REQUIEREN PAGO === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Miembros que Requieren Pago</h2>
        <canvas id="doughnutMiembros" height="120"></canvas>
    </div>

    {{-- === RANKING DE PLANES === --}}
    <div class="g_panel col-span-2">
        <h2 class="g_panel_titulo">Ranking de Planes más Consumidos</h2>
        <canvas id="barChartPlanes" height="120"></canvas>
    </div>

    {{-- === TOP CANDIDATOS === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Top Candidatos</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Total (S/.)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCandidatos as $c)
                    <tr>
                        <td>{{ $c->candidato->nombre ?? 'Sin nombre' }}</td>
                        <td>{{ $c->cantidad }}</td>
                        <td>S/. {{ number_format($c->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- === TOP AUSPICIADORES === --}}
    <div class="g_panel">
        <h2 class="g_panel_titulo">Top Auspiciadores</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Total (S/.)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topAuspiciadores as $a)
                    <tr>
                        <td>{{ $a->auspiciador->nombre ?? 'Sin nombre' }}</td>
                        <td>{{ $a->cantidad }}</td>
                        <td>S/. {{ number_format($a->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- === PAGOS NO REALIZADOS === --}}
    <div class="g_panel col-span-2">
        <h2 class="g_panel_titulo">Pagos No Realizados ({{ $pagosNoRealizados }})</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mes</th>
                    <th>Precio</th>
                    <th>Fecha Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagosFallidos as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->mes }}</td>
                        <td>S/. {{ number_format($p->precio_pagado, 2) }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- === ÚLTIMOS PAGOS === --}}
    <div class="g_panel col-span-2">
        <h2 class="g_panel_titulo">Últimos Pagos</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mes</th>
                    <th>Precio</th>
                    <th>Fecha Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ultimosPagos as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->mes }}</td>
                        <td>S/. {{ number_format($p->precio_pagado, 2) }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labelsMes = @json($labels);
        const datosPagosMes = @json($datosPagos);
        const datosRecaudacionMes = @json($datosRecaudacion);

        const labelsAnio = @json(array_keys($pagosPorAnio ?? []));
        const datosPagosAnio = @json(array_values($pagosPorAnio ?? []));
        const datosRecaudacionAnio = @json(array_values($recaudacionPorAnio ?? []));

        const recaudacionPorTipo = @json(array_values($recaudacionPorTipo ?? []));
        const tipos = ['Candidatos', 'Auspiciadores'];

        const miembrosPagoPorTipo = @json(array_values($miembrosPagoPorTipo ?? []));
        const tiposMiembros = ['Candidatos', 'Auspiciadores'];

        // Ranking de planes
        const planesLabels = @json($planes->pluck('nombre'));
        const planesData = @json($planes->pluck('total'));

        // Mes
        new Chart(document.getElementById('barChartPagos'), {
            type: 'bar',
            data: {
                labels: labelsMes,
                datasets: [{
                    label: 'Pagos',
                    data: datosPagosMes,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true
            }
        });
        new Chart(document.getElementById('barChartRecaudacion'), {
            type: 'bar',
            data: {
                labels: labelsMes,
                datasets: [{
                    label: 'Recaudación S/.',
                    data: datosRecaudacionMes,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)'
                }]
            },
            options: {
                responsive: true
            }
        });

        // Año
        new Chart(document.getElementById('barChartPagosAnio'), {
            type: 'bar',
            data: {
                labels: labelsAnio,
                datasets: [{
                    label: 'Pagos',
                    data: datosPagosAnio,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)'
                }]
            },
            options: {
                responsive: true
            }
        });
        new Chart(document.getElementById('barChartRecaudacionAnio'), {
            type: 'bar',
            data: {
                labels: labelsAnio,
                datasets: [{
                    label: 'Recaudación S/.',
                    data: datosRecaudacionAnio,
                    backgroundColor: 'rgba(153, 102, 255, 0.7)'
                }]
            },
            options: {
                responsive: true
            }
        });

        // Doughnut por tipo
        new Chart(document.getElementById('doughnutTipo'), {
            type: 'doughnut',
            data: {
                labels: tipos,
                datasets: [{
                    data: recaudacionPorTipo,
                    backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Doughnut miembros que requieren pago
        new Chart(document.getElementById('doughnutMiembros'), {
            type: 'doughnut',
            data: {
                labels: tiposMiembros,
                datasets: [{
                    data: miembrosPagoPorTipo,
                    backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)']
                }]
            },
            options: {
                responsive: true
            }
        });


        new Chart(document.getElementById('barChartPlanes'), {
            type: 'bar',
            data: {
                labels: planesLabels,
                datasets: [{
                    label: 'Cantidad de Membresías',
                    data: planesData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)', // rojo
                        'rgba(54, 162, 235, 0.7)', // azul
                        'rgba(255, 206, 86, 0.7)', // amarillo
                        'rgba(75, 192, 192, 0.7)', // verde agua
                        'rgba(153, 102, 255, 0.7)', // morado
                        'rgba(255, 159, 64, 0.7)' // naranja
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

    });
</script>
