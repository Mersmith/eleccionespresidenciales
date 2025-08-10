@section('tituloPagina', 'Candidatos')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Candidatos</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
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
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>P. Gobierno</th>
                                <th>Video</th>
                                <th>Descripción</th>
                                <th>Redes</th>
                                <th>Partido</th>
                                <th>Plan</th>
                                <th>Oficial</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidatos as $index => $item)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td><img src="{{ $item->foto }}"></td>
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
                                    <td class="g_inferior g_resumir">
                                        @if (!empty($item->video_presentacion))
                                            <a href="{{ $item->video_presentacion }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <span><i class="fa-brands fa-youtube"></i></span>
                                                {{ $item->video_presentacion }}
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
                                    <td class="g_resaltar">
                                        @if ($item->partido)
                                            ID: {{ $item->partido->id }} - {{ $item->partido->nombre }}
                                        @endif
                                    </td>
                                    <td class="g_resaltar">ID: {{ $item->plan->id }} - {{ $item->plan->nombre }}</td>
                                    <td>
                                        <span
                                            class="{{ $item->candidato_oficial ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->candidato_oficial ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.candidato.vista.editar', $item->id) }}"
                                            class="g_accion_editar">
                                            <span><i class="fa-solid fa-pencil"></i></span>
                                        </a>

                                        <a href="{{ route('admin.candidato.social.editar', $item->id) }}"
                                            class="g_resaltar">
                                            <span><i class="fa-brands fa-facebook"></i></span>
                                        </a>

                                        <a href="{{ route('admin.candidato.cargo.crear', $item->id) }}"
                                            class="g_activo">
                                            <span><i class="fa-solid fa-user-tie"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($candidatos->hasPages())
                <div>
                    {{ $candidatos->onEachSide(1)->links() }}
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
