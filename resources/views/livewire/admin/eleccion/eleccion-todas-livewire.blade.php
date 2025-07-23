@section('tituloPagina', 'Locales')

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
                    <input type="text" wire:model.live.debounce.500ms="buscar" placeholder="Buscar por nombre...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
    
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha de votación</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elecciones as $index => $item)
                                <tr>
                                    <td>{{ ($elecciones->currentPage() - 1) * $elecciones->perPage() + $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->nombre }}</td>
                                    <td>{{ $item->tipo }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_votacion)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="{{ $item->activo ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->activo ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.eleccion.vista.editar', $item->id) }}" class="g_accion_editar">
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
                <div class="mt-4">
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
