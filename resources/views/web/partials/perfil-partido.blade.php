@if (!empty($p_elemento))
    <div class="partials_contenedor_perfil_partido g_card_panel">
        <div class="partido_imagen_contenedor">
            @if (!empty($item->logo))
                <img src="{{ $item->logo }}" alt="{{ $item->nombre }}" class="imagen_partido">
            @else
                <img src="{{ asset('assets/images/partido/partido-1.jpg') }}" alt="" class="imagen_partido">
            @endif
        </div>

        <div class="nombres_partido">
            <div class="nombres">
                <h3 class="g_texto_nivel_6">{{ $p_elemento->nombre }} </h3>
                <p class="g_texto_nivel_7">{{ $p_elemento->descripcion }} </p>
            </div>

            @if ($p_elemento->alianza)
                <p><span class="g_texto_nivel_1">Está en una alianza con:</span><a href="{{ route('alianza', ['id' => $p_elemento->alianza->id, 'slug' => $p_elemento->alianza->slug]) }}">{{ $p_elemento->alianza->nombre }}</a> </p>
            @endif
        </div>
    </div>
@endif
