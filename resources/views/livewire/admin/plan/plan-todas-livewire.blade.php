@section('tituloPagina', 'Planes')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Planes</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.plan.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.plan.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($planes->count())
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
                            <th>Nombre</th>
                            <th>Requiere pago</th>
                            <th>Precio</th>
                            <th>Descripion</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planes as $index => $item)
                        <tr>
                            <td> {{ $index + 1 }} </td>
                            <td class="g_resaltar">{{ $item->id }}: {{ $item->nombre }}</td>
                            <td>
                                <span class="{{ $item->requiere_pago ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->requiere_pago ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>{{ $item->precio }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td class="centrar_iconos">
                                <a href="{{ route('admin.plan.vista.editar', $item->id) }}" class="g_accion_editar">
                                    <span><i class="fa-solid fa-pencil"></i></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($planes->hasPages())
        <div>
            {{ $planes->onEachSide(1)->links() }}
        </div>
        @endif

        @else
        <div class="g_vacio">
            <p>No hay planes disponibles.</p>
            <i class="fa-regular fa-face-grin-wink"></i>
        </div>
        @endif
    </div>
</div>
