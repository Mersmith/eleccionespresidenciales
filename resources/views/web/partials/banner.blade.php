@if (!empty($p_elemento))
    <div class="partials_contenedor_banner">
        <a href="{{ $p_elemento['link'] }}">
            <img src="{{ $p_elemento['imagen_computadora'] }}" alt="" class="imagen_computadora" />

            <img src="{{ $p_elemento['imagen_movil'] }}" alt="" class="imagen_movil" />
        </a>
    </div>
@endif
