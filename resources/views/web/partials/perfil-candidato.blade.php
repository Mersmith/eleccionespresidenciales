@if (!empty($p_elemento))
    <div class="partials_contenedor_perfil_candidato g_card_panel">
        <div class="candidato_imagen_contenedor">
            <img class="imagen_candidato" src="{{ $p_elemento->foto }}" alt="" />

            <img class="logo_partido" src="{{ $p_elemento->partido?->logo }}" alt="" />
        </div>

        <div class="nombres_partido">
            <div class="nombres">
                @if (!empty($p_elemento->redes_sociales))
                    <div class="redes_sociales">
                        @foreach ($p_elemento->redes_sociales as $elemento)
                            @if (!empty($elemento['url']))
                                <a href="{{ $elemento['url'] }}" target="_blank"
                                    style="color: {{ $elemento['color'] }}">
                                    {!! $elemento['icono'] !!}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
                <h3 class="g_texto_nivel_6">{{ $p_elemento->nombre }} </h3>
                <p class="g_texto_nivel_7">{{ $p_elemento->descripcion }} </p>
            </div>

            @if ($p_elemento->partido)
                <div class="partido">
                    <h3 class="g_texto_nivel_1">{{ $p_elemento->partido->nombre }} </h3>
                    <p class="g_texto_nivel_2">{{ $p_elemento->partido->descripcion }} </p>
                </div>
            @endif
        </div>
    </div>
@endif
