@if ($p_elemento->isNotEmpty())
    <div class="partials_contenedor_candidatura_cargo g_card_panel">
        <h2 class="g_texto_nivel_6 g_texto_subrayado"><i class="fas fa-history"></i> {{ $p_titulo }}</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="item">
                <h4 class="g_texto_nivel_4"><i class="fas fa-vote-yea"></i> {{ $item->nombre }}</h4>

                <p class="g_texto_nivel_2"><i class="fas fa-flag"></i>

                    @if ($item->partido)
                        <strong>Partido:</strong> {{ $item->partido->nombre ?? '-' }}
                    @elseif ($item->alianza)
                        <strong>Alianza:</strong> {{ $item->alianza->nombre ?? '-' }}
                    @else
                        Sin agrupación
                    @endif
                </p>
            </div>
        @endforeach
    </div>
@endif
