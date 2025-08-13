@section('tituloPagina', 'Anuncios')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Anuncios</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.anuncio.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.anuncio.vista.crear') }}" class="g_boton g_boton_primary">
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
        @if ($anuncios->count())
            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Link</th>
                                <th>Auspiciador</th>
                                <th>Candidato</th>
                                <th>Partido</th>
                                <th>Alianza</th>
                                <th>Pagina</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anuncios as $index => $item)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td><img src="{{ $item->url_imagen }}"></td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                    <td class="g_inferior g_resumir">
                                        <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">
                                            <span><i class="fa-solid fa-book"></i></span>
                                            {{ $item->link }}
                                        </a>
                                    </td>
                                    <td>{{ $item->auspiciador ? $item->auspiciador->nombre : '-' }}</td>
                                    <td>{{ $item->candidato ? $item->candidato->nombre : '-' }}</td>
                                    <td>{{ $item->partido ? $item->partido->nombre : '-' }}</td>
                                    <td>{{ $item->alianza ? $item->alianza->nombre : '-' }}</td>

                                    <td class="g_inferior g_resumir">{{ $item->pagina }}</td>

                                    <td class="g_inferior g_resumir">{{ $item->fecha_inicio }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->fecha_fin }}</td>                          
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.anuncio.vista.editar', $item->id) }}"
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

            @if ($anuncios->hasPages())
                <div>
                    {{ $anuncios->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay anuncios disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
