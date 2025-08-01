@if (!empty($p_elemento))
    <div class="partials_contenedor_candidatura_cargo g_card_panel">
        <h2 class="g_texto_nivel_6 g_texto_subrayado"><i class="fas fa-history"></i> Candidaturas</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="item">
                <h4 class="g_texto_nivel_4"><i class="fas fa-vote-yea"></i> {{ $item->eleccion->nombre }}</h4>
                <h5 class="g_texto_nivel_1"><i class="fas fa-user-tie"></i> <strong>Cargo:</strong>
                    {{ $item->cargo->nombre }}</h5>
                <p class="g_texto_nivel_2"><i class="fas fa-flag"></i> <strong>Partido:</strong> {{ $item->partido->nombre ?? '-' }}</p>
                <span class="g_texto_nivel_3"><i class="fas fa-map-marker-alt"></i>
                    {{ $item->pais->nombre ?? '' }}
                    {{ $item->region->nombre ?? '' }}
                    {{ $item->provincia->nombre ?? '' }}
                    {{ $item->distrito->nombre ?? '' }}
                </span>
            </div>
        @endforeach
    </div>
@endif
