@section('tituloPagina', 'Posts')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Posts</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.post.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.post.vista.crear') }}" class="g_boton g_boton_primary">
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
        @if ($posts->count())
            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Slug</th>
                                <th>Candidato</th>
                                <th>Partido</th>
                                <th>Alianza</th>
                                <th>Descripcion</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index => $item)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td><img src="{{ $item->image }}"></td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->titulo }}</td>
                                    <td class="g_inferior g_resumir">
                                        <a href="{{ route('post', ['id' => $item->id, 'slug' => $item->slug]) }}" target="_blank" rel="noopener noreferrer">
                                            <span><i class="fa-solid fa-book"></i></span>
                                            {{ $item->slug }}
                                        </a>
                                    </td>
                                    <td>{{ $item->candidato ? $item->candidato->nombre : '-' }}</td>
                                    <td>{{ $item->partido ? $item->partido->nombre : '-' }}</td>
                                    <td>{{ $item->alianza ? $item->alianza->nombre : '-' }}</td>

                                    <td class="g_inferior g_resumir">{{ $item->meta_description }}</td>
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>

                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.post.vista.editar', $item->id) }}"
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

            @if ($posts->hasPages())
                <div>
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay posts disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
