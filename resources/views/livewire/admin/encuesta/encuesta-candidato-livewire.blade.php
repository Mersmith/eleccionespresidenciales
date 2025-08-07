@section('tituloPagina', 'Agregar candidatos')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <div>
            <!--TITULO-->
            <h2>{{ $encuesta->nombre }}</h2>
            <p> <strong>Nivel: </strong> {{ $encuesta->nivel->nombre }}</p>
            <p><strong>Cargo: </strong>{{ $encuesta->cargo->nombre }}</p>
        </div>
        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.encuesta.vista.editar', $encuesta->id) }}" class="g_boton g_boton_secondary">
                Editar <i class="fa-solid fa-pencil"></i></a>

            <a href="{{ route('encuesta', $encuesta->id) }}" class="g_boton g_boton_primary">
                Votar <i class="fa-solid fa-check-to-slot"></i></a>

            <a href="{{ route('encuesta.resultado', $encuesta->id) }}" class="g_boton g_boton_danger">
                Resultados <i class="fa-solid fa-chart-simple"></i></a>

            <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
    <div class="g_fila">
        <!--TITULO-->

        <div class="g_columna_6">
            <!--TABLA-->
            <div class="g_panel">
                <h2>Participantes</h2>

                <div class="tabla_cabecera">
                    <div class="tabla_cabecera_buscar">
                        <form action="">
                            <input type="text" wire:model.live.debounce.1300ms="searchAgregados" id="searchAgregados"
                                name="searchAgregados" placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>
                @if ($candidatosAgregados->count())
                    <!--TABLA CONTENIDO-->
                    <div class="tabla_contenido g_margin_bottom_20">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        {{-- <th>Cargo</th> --}}
                                        <th>Partido</th>
                                        <th>Número</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatosAgregados as $index => $postulacion)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td class="g_resaltar">{{ $postulacion->candidato->nombre }}</td>
                                            {{-- <td class="g_resaltar">{{ $postulacion->cargo->nombre }}</td> --}}
                                            <td>
                                                @if ($postulacion->partido)
                                                    {{ $postulacion->partido->nombre }}
                                                @elseif ($postulacion->alianza)
                                                    {{ $postulacion->alianza->nombre }}
                                                @else
                                                    Sin afiliación
                                                @endif
                                            </td>
                                            <td class="g_resaltar"></td>
                                            <td class="centrar_iconos">
                                                <button wire:click="quitarCandidato({{ $postulacion->id }})"
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
                @else
                    <div class="g_vacio">
                        <p>No hay participantes disponibles.</p>
                        <i class="fa-regular fa-face-grin-wink"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="g_columna_6">
            <!--TABLA-->
            <div class="g_panel">
                <h2>Disponibles</h2>

                <div class="tabla_cabecera">
                    <div class="tabla_cabecera_buscar">
                        <form action="">
                            <input type="text" wire:model.live.debounce.1300ms="searchDisponibles"
                                id="searchDisponibles" name="searchDisponibles" placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>
                @if ($candidatosDisponibles->count())
                    <!--TABLA CONTENIDO-->
                    <div class="tabla_contenido g_margin_bottom_20">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        {{-- <th>Cargo</th> --}}
                                        <th>Partido</th>
                                        <th>Número</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatosDisponibles as $index => $postulacion)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td class="g_resaltar">{{ $postulacion->candidato->nombre }}</td>
                                            {{-- <td class="g_resaltar">{{ $postulacion->cargo->nombre }}</td> --}}
                                            <td>
                                                @if ($postulacion->partido)
                                                    {{ $postulacion->partido->nombre }}
                                                @elseif ($postulacion->alianza)
                                                    {{ $postulacion->alianza->nombre }}
                                                @else
                                                    Sin afiliación
                                                @endif
                                            </td>
                                            <td class="g_resaltar"></td>
                                            <td class="centrar_iconos">
                                                <button wire:click="agregarCandidato({{ $postulacion->id }})"
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
                        {{ $candidatosDisponibles->links() }}
                    </div>
                @else
                    <div class="g_vacio">
                        <p>No hay candidatos disponibles.</p>
                        <i class="fa-regular fa-face-grin-wink"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
