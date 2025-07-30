@if (!empty($p_elemento))
    <div class="partials_contenedor_candidatura_cargo">
        <h2><i class="fas fa-history"></i> Historial de Candidaturas</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="item">
                <h4><i class="fas fa-vote-yea"></i> {{ $item->nombre }}</h4>
                <p><i class="fas fa-flag"></i> Partido: {{ $item->partido->nombre ?? '-' }}</p>
            </div>
        @endforeach
    </div>
@endif
