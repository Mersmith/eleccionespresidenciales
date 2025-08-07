@section('tituloPagina', 'Auspiciadores')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Auspiciadores</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.auspiciador.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.auspiciador.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($auspiciadores->count())
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
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Celular</th>
                                <th>Observación</th>
                                <th>Plan</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auspiciadores as $index => $item)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td class="g_resaltar">ID: {{ $item->id }} - {{ $item->nombre }}</td>
                                    <td >{{ $item->empresa }}</td>
                                    <td >{{ $item->celular }}</td>                              
                                    <td class="g_inferior g_resumir">{{ $item->observacion }}</td>                        
                                    <td class="g_resaltar">ID: {{ $item->plan->id }} - {{ $item->plan->nombre }}</td>                               
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.auspiciador.vista.editar', $item->id) }}"
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

            @if ($auspiciadores->hasPages())
                <div>
                    {{ $auspiciadores->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay auspiciadores disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
