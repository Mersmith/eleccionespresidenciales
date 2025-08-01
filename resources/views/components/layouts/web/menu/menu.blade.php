<div class="contenedor_menu_enlaces_rapido">
    @php
        $json_menu = file_get_contents('menu-enlaces.json');
        $menuPrincipal = collect(json_decode($json_menu, true));
    @endphp

    <li class="menu_item_con_submenu">
        <a href="{{ route('encuestas', [
            'tipoEleccionSeleccionada' => config('constantes.TIPO_ELECCION_GENERAL_ID'),
            'eleccionSeleccionada' => config('constantes.TIPO_ELECCION_GENERAL_ID'),
            'cargoSeleccionada' => 1
        ]) }}">
            PRESIDENTE
        </a>
    </li>

    <li class="menu_item_con_submenu">
        <a href="{{ route('encuestas', [
            'tipoEleccionSeleccionada' => config('constantes.TIPO_ELECCION_REGIONAL_ID'),
            'eleccionSeleccionada' => config('constantes.ELECCION_REGIONAL_ID'),
            'cargoSeleccionada' => 9,
            'regionSeleccionada' => 14,
            'provinciaSeleccionada' => 135
        ]) }}">
            ALCALDÍA LIMA
        </a>
    </li>

    <li class="menu_item_con_submenu">
        <a href="#">
            {{ $menuPrincipal[2]['nombre'] }}
            <i class="fa-solid fa-angle-down icon_submenu"></i>
        </a>
    
        @if (!empty($menuPrincipal[2]['submenu']))
            <ul class="submenu_oculto">
                @foreach ($menuPrincipal[2]['submenu'] as $subitem)
                    <li>
                        <a href="{{ route('encuestas', [
                            'tipoEleccionSeleccionada' => config('constantes.TIPO_ELECCION_REGIONAL_ID'),
                            'eleccionSeleccionada' => config('constantes.ELECCION_REGIONAL_ID'),
                            'cargoSeleccionada' => 11,
                            'regionSeleccionada' => 14,
                            'provinciaSeleccionada' => 135,
                            'distritoSeleccionada' => $subitem['distrito_id']
                        ]) }}">{{ $subitem['nombre'] }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>    
</div>