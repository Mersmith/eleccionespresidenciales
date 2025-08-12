@if ($p_elemento->isNotEmpty())
    <div class="partials_contenedor_candidatura_cargo g_card_panel">
        <h2 class="g_texto_nivel_6 g_texto_subrayado"><i class="fas fa-history"></i> {{ $p_titulo }}</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="item">
                <h4 class="g_texto_nivel_4"><i class="fas fa-vote-yea"></i> <a
                        href="{{ route('candidato', ['id' => $item->id, 'slug' => $item->slug]) }}">{{ $item->nombre }}</a>
                </h4>

                <p class="g_texto_nivel_2"><i class="fas fa-flag"></i>
                    @if ($item->partido)
                        <strong>Partido:</strong> <a
                            href="{{ route('partido', ['id' => $item->partido->id, 'slug' => $item->partido->slug]) }}">{{ $item->partido->nombre ?? '-' }}</a>
                    @elseif ($item->alianza)
                        <strong>Alianza:</strong> <a
                            href="{{ route('alianza', ['id' => $item->alianza->id, 'slug' => $item->alianza->slug]) }}">{{ $item->alianza->nombre ?? '-' }}</a>
                    @else
                        Sin Agrupación
                    @endif
                </p>
            </div>
        @endforeach
    </div>
@endif
