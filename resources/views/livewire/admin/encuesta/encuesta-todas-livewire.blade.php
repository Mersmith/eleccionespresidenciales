@section('tituloPagina', 'Encuesta')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Encuestas</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.encuesta.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($encuestas->count())
        <div class="tabla_cabecera">
            <div class="tabla_cabecera_buscar">
                <form action="">
                    <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar" placeholder="Buscar...">
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
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Cargo</th>
                            <th>Región</th>
                            <th>Provincia</th>
                            <th>Distrito</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($encuestas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="g_resaltar">{{ $item->titulo }}</td>
                                <td>{{ $item->categoria->nombre ?? '-' }}</td>
                                <td>{{ $item->cargo->nombre ?? '-' }}</td>
                                <td>{{ $item->region->nombre ?? '-' }}</td>
                                <td>{{ $item->provincia->nombre ?? '-' }}</td>
                                <td>{{ $item->distrito->nombre ?? '-' }}</td>
                                <td>{{ $item->fecha_inicio }}</td>
                                <td>{{ $item->fecha_fin }}</td>
                                <td>
                                    @if ($item->activa)
                                        <span class="badge badge-success">Activa</span>
                                    @else
                                        <span class="badge badge-danger">Inactiva</span>
                                    @endif
                                </td>
                                <td class="centrar_iconos">
                                    <a href="{{ route('admin.encuesta.vista.editar', $item) }}" class="g_accion_editar">
                                        <span><i class="fa-solid fa-pencil"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        @if ($encuestas->hasPages())
        <div>
            {{ $encuestas->onEachSide(1)->links() }}
        </div>
        @endif

        @else
        <div class="g_vacio">
            <p>No hay encuestas disponibles.</p>
            <i class="fa-regular fa-face-grin-wink"></i>
        </div>
        @endif
    </div>
</div>
