@if (!empty($p_elemento) && !empty($p_elemento->imagenes))
    <div>
        @if ($p_elemento->nombre)
            @include('ecommerce.partials.titulo', [
                'p_contenido' => $p_elemento->nombre,
                'p_alineacion' => 'center',
                'p_color' => '#000000',
            ])
        @endif

        <div class="partials_contenedor_vitrina">
            @foreach ($p_elemento->imagenes as $item)
                <a href="{{ $item['link'] }}">
                    <img src="{{ $item['imagen_computadora'] }}" class="imagen_computadora" />
                    <img src="{{ $item['imagen_movil'] }}" class="imagen_movil" />
                </a>
            @endforeach
        </div>
    </div>
@endif
