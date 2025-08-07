@section('tituloPagina', 'Membresia historial')

@section('anchoPantalla', '100%')


<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Membresia historial</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.membresia.vista.gestion') }}" class="g_boton g_boton_primary">
                Deudores <i class="fa-solid fa-comments-dollar"></i></a>

            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_secondary">
                Candidato <i class="fa-solid fa-user-tie"></i></a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_panel">
            <div class="g_fila">
                <div class="g_columna_8">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Filtros</h4>

                    <div class="g_fila g_margin_bottom_20">
                        <!--NIVELES-->
                        <div class="g_columna_4">
                            <div>
                                <label class="font-semibold">Mes:</label>
                                <input type="month" wire:model.live="mesSeleccionado"
                                    class="border rounded px-2 py-1" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        <div class="tabla_cabecera">
            <div class="tabla_cabecera_buscar">
                <form action="">
                    <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar"
                        placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>

        @if ($historial->count())
            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Candidato</th>
                                <th>Plan</th>
                                <th>Precio pagado</th>
                                <th>Mes</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($historial as $m)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">ID: {{ $m->candidato->id }} - {{ $m->candidato->nombre }}
                                    </td>
                                    <td class="g_resaltar">ID: {{ $m->candidato->plan->id }} -
                                        {{ $m->candidato->plan->nombre }}</td>
                                    <td> {{ $m->precio_pagado }} </td>
                                    <td> {{ $m->mes }} </td>
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

                            @empty
                                <tr>
                                    <td colspan="3" class="py-4">No hay historial que requieran pago.</td>
                                </tr>
                            @endforelse
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
