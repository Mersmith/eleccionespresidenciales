@section('tituloPagina', 'Partidos')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Partidos</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.partido.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.partido.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($partidos->count())
            <div class="tabla_cabecera">
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar"
                            placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Logo</th>
                                <th>Nombre</th>
                                <th>Plan</th>
                                <th>Descripción</th>
                                <th>Redes</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partidos as $index => $item)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td><img src="{{ $item->logo }}"></td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                    <td class="g_inferior g_resumir">
                                        @if (!empty($item->plan_gobierno))
                                            <a href="{{ $item->plan_gobierno }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <span><i class="fa-solid fa-book"></i></span>
                                                {{ $item->plan_gobierno }}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="g_inferior g_resumir">{{ $item->descripcion }}</td>
                                    <td>
                                        @php
                                            $redes = json_decode($item->redes_sociales, true);
                                        @endphp

                                        @if (!empty($redes) && is_array($redes))
                                            @foreach ($redes as $red)
                                                @if (!empty($red['url']))
                                                    <a href="{{ $red['url'] }}" target="_blank"
                                                        style="color: {{ $red['color'] }}; margin-right:5px;">
                                                        {!! $red['icono'] !!}
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.partido.vista.editar', $item->id) }}"
                                            class="g_accion_editar">
                                            <span><i class="fa-solid fa-pencil"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($partidos->hasPages())
                <div>
                    {{ $partidos->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay partidos disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
