@section('tituloPagina', 'Membresía auspiciador historial')
@section('anchoPantalla', '100%')

<div>
    <!-- CABECERA -->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Membresía auspiciador historial</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.membresia.auspiciador.vista.gestion') }}" class="g_boton g_boton_primary">
                Deudores <i class="fa-solid fa-comments-dollar"></i>
            </a>
            <a href="{{ route('admin.auspiciador.vista.todas') }}" class="g_boton g_boton_secondary">
                Auspiciador <i class="fa-solid fa-handshake"></i>
            </a>
        </div>
    </div>

    <!-- FORMULARIO FILTROS -->
    <div class="formulario">
        <div class="g_panel">
            <div class="g_fila">
                <div class="g_columna_8">
                    <h4 class="g_panel_titulo">Filtros</h4>
                    <div class="g_fila g_margin_bottom_20">
                        <div class="g_columna_4">
                            <label class="font-semibold">Mes:</label>
                            <input type="month" wire:model.live="mesSeleccionado" class="border rounded px-2 py-1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLA -->
    <div class="g_panel">
        <div class="tabla_cabecera">
            <div class="tabla_cabecera_buscar">
                <form>
                    <input type="text" wire:model.live.debounce.1300ms="buscar" placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>

        @if ($historial->count())
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Auspiciador</th>
                                <th>Plan</th>
                                <th>Precio pagado</th>
                                <th>Mes</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historial as $m)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">
                                        ID: {{ $m->auspiciador->id }} - {{ $m->auspiciador->nombre }}
                                    </td>
                                    <td class="g_resaltar">
                                        ID: {{ $m->auspiciador->plan->id ?? '-' }} -
                                        {{ $m->auspiciador->plan->nombre ?? 'Sin plan' }}
                                    </td>
                                    <td>{{ $m->precio_pagado }}</td>
                                    <td>{{ $m->mes }}</td>
                                    <td>
                                        @if ($m->pagado)
                                            <span class="text-green-600 font-semibold">✅ Pagado</span>
                                        @else
                                            <span class="text-red-600 font-semibold">❌ No pagado</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="togglePagado({{ $m->id }})"
                                            class="g_boton {{ $m->pagado ? 'g_boton_danger' : 'g_boton_success' }}">
                                            {{ $m->pagado ? 'Marcar como NO pagado' : 'Marcar como pagado' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($historial->hasPages())
                <div>
                    {{ $historial->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay historial disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
