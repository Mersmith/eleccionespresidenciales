@section('tituloPagina', 'Elecciones')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Elecciones</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.eleccion.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($elecciones->count())
            <div class="tabla_cabecera">
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar"
                            placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Descripcion</th>
                                <th>Fecha de votación</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elecciones as $index => $item)
                                <tr>
                                    <td>{{ ($elecciones->currentPage() - 1) * $elecciones->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                    <td><img src="{{ $item->imagen_ruta }}" alt=""></td>
                                    <td class="g_inferior g_resumir">{{ $item->descripcion }}</td>
                                    <td>{{ $item->fecha_votacion }}</td>
                                    <td class="g_inferior">
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.eleccion.vista.editar', $item->id) }}"
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

            @if ($elecciones->hasPages())
                <div>
                    {{ $elecciones->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay elecciones registradas.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>

</div>
