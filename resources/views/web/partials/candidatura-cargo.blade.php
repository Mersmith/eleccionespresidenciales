@if (!empty($p_elemento))
    <div class="partials_contenedor_candidatura_cargo">
        <h2><i class="fas fa-history"></i> Historial de Candidaturas</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="item">
                <h4><i class="fas fa-vote-yea"></i> {{ $item->eleccion->nombre }}</h4>
                <h5><i class="fas fa-user-tie"></i> <strong>Cargo:</strong>
                    {{ $item->cargo->nombre }}</h5>
                <p><i class="fas fa-flag"></i> Partido: {{ $item->partido->nombre ?? '-' }}</p>
                <span><i class="fas fa-map-marker-alt"></i>
                    {{ $item->pais->nombre ?? '' }}
                    {{ $item->region->nombre ?? '' }}
                    {{ $item->provincia->nombre ?? '' }}
                    {{ $item->distrito->nombre ?? '' }}
                </span>
            </div>
        @endforeach
    </div>
@endif
