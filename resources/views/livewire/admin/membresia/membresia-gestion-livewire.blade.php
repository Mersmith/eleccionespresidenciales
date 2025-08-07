@section('tituloPagina', 'Membresia gestión')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Membresia gestión</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.membresia.vista.historial') }}" class="g_boton g_boton_primary">
                Historial <i class="fa-solid fa-clock-rotate-left"></i></a>

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

            <div>
                <div class="formulario_botones">
                    <button wire:click="loadMembresias" class="guardar">Refrescar</button>
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

        @if ($candidatos->count())
            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Candidato</th>
                                <th>Plan</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($candidatos as $c)
                                @php $m = $membresiasMes[$c->id] ?? null; @endphp

                                @if (!($m && $m->pagado))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="g_resaltar">ID: {{ $c->id }} - {{ $c->nombre }}</td>
                                        <td class="g_resaltar">ID: {{ $c->plan->id }} - {{ $c->plan->nombre }}</td>
                                        <td>
                                            @if ($m)
                                                ❌ No pagado
                                            @else
                                                -- Sin registro
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="togglePagadoMes({{ $c->id }})"
                                                class="g_boton g_boton_success">
                                                Marcar como pagado
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4">No hay candidatos que requieran pago.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            @if ($candidatos->hasPages())
                <div>
                    {{ $candidatos->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay candidatos disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
