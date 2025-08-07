@section('tituloPagina', 'Membresía auspiciador gestión')
@section('anchoPantalla', '100%')

<div>
    <!-- Cabecera -->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Membresía auspiciador gestión</h2>

        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.membresia.auspiciador.vista.historial') }}" class="g_boton g_boton_primary">
                Historial <i class="fa-solid fa-clock-rotate-left"></i></a>

            <a href="{{ route('admin.auspiciador.vista.todas') }}" class="g_boton g_boton_secondary">
                Auspiciador <i class="fa-solid fa-handshake"></i></a>
        </div>
    </div>

    <!-- Filtros -->
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

            <div>
                <div class="formulario_botones">
                    <button wire:click="loadMembresias" class="guardar">Refrescar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="g_panel">
        <div class="tabla_cabecera">
            <div class="tabla_cabecera_buscar">
                <form action="">
                    <input type="text" wire:model.live.debounce.1300ms="buscar" placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>

        @if ($auspiciadores->count())
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Auspiciador</th>
                                <th>Plan</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auspiciadores as $a)
                                @php $m = $membresiasMes[$a->id] ?? null; @endphp

                                @if (!($m && $m->pagado))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="g_resaltar">ID: {{ $a->id }} - {{ $a->nombre }}</td>
                                        <td class="g_resaltar">
                                            @if ($a->plan)
                                                ID: {{ $a->plan->id }} - {{ $a->plan->nombre }}
                                            @else
                                                Sin plan
                                            @endif
                                        </td>
                                        <td>{{ $a->plan->precio ?? '0.00' }}</td>
                                        <td>
                                            @if ($m)
                                                ❌ No pagado
                                            @else
                                                -- Sin registro
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="togglePagadoMes({{ $a->id }})"
                                                class="g_boton g_boton_success">
                                                Marcar como pagado
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($auspiciadores->hasPages())
                <div>
                    {{ $auspiciadores->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay auspiciadores disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
