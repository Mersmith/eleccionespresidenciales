@if (!empty($p_elemento))
    <div class="partials_contenedor_perfil_partido g_card_panel">
        <div class="partido_imagen_contenedor">
            <img class="imagen_partido" src="{{ $p_elemento->logo }}" alt="" />
        </div>

        <div class="nombres_partido">
            <div class="nombres">
                <h3 class="g_texto_nivel_6">{{ $p_elemento->nombre }} </h3>
                <p class="g_texto_nivel_7">{{ $p_elemento->descripcion }} </p>
            </div>

            @if ($p_elemento->alianza)
                <p>Está en una alianza: {{ $p_elemento->alianza->nombre ?? 'Sin nombre' }}</p>
            @endif
        </div>
    </div>
@endif
