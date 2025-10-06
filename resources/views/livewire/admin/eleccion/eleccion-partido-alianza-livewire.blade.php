@section('tituloPagina', 'Agregar participantes')
@section('anchoPantalla', '100%')

<div>
    <div class="g_panel cabecera_titulo_pagina">
        <div>
            <h2>{{ $eleccion->nombre }}</h2>
        </div>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <div class="g_fila">
        <!-- PARTICIPANTES AGREGADOS -->
        <div class="g_columna_6">
            <div class="g_panel">
                <h2>Participantes</h2>

                <div class="tabla_cabecera">
                    <div class="tabla_cabecera_buscar">
                        <form action="">
                            <input type="text" wire:model.live.debounce.800ms="searchAgregados" id="searchAgregados"
                                placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>

                @if ($agregados->count())
                    <div class="tabla_contenido g_margin_bottom_20">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agregados as $index => $item)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td>{{ $item['nombre'] }}</td>
                                            <td>{{ ucfirst($item['tipo']) }}</td>
                                            <td class="centrar_iconos">
                                                <button wire:click="quitar({{ $item['id'] }}, '{{ $item['tipo'] }}')"
                                                    class="g_boton g_boton_danger">
                                                    Quitar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="g_paginacion">
                        {{ $agregados->links() }}
                    </div>
                @else
                    <div class="g_vacio">
                        <p>No hay participantes disponibles.</p>
                        <i class="fa-regular fa-face-grin-wink"></i>
                    </div>
                @endif

            </div>
        </div>

        <!-- DISPONIBLES -->
        <div class="g_columna_6">
            <div class="g_panel">
                <h2>Disponibles</h2>

                <div class="tabla_cabecera">
                    <div class="tabla_cabecera_buscar">
                        <form action="">
                            <input type="text" wire:model.live.debounce.800ms="searchDisponibles"
                                id="searchDisponibles" placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>

                @if ($disponibles->count())
                    <div class="tabla_contenido g_margin_bottom_20">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disponibles as $index => $item)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td>{{ $item['nombre'] }}</td>
                                            <td>{{ ucfirst($item['tipo']) }}</td>
                                            <td class="centrar_iconos">
                                                <button
                                                    wire:click="agregar({{ $item['id'] }}, '{{ $item['tipo'] }}')"
                                                    class="g_boton g_boton_primary">
                                                    Agregar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        {{ $disponibles->links() }}
                    </div>
                @else
                    <div class="g_vacio">
                        <p>No hay partidos o alianzas disponibles.</p>
                        <i class="fa-regular fa-face-grin-wink"></i>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
