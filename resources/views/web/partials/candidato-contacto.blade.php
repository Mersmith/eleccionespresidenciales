@if (!empty($candidato_partido->contacto) && collect($candidato_partido->contacto)->filter(fn($valor) => !empty($valor))->isNotEmpty())
    <div class="g_card_panel g_margin_bottom_20">
        <h3 class="g_texto_nivel_4">CONTACTOS</h3>

        @foreach ($candidato_partido->contacto as $tipo => $valor)
            @if (!empty($valor))
                <p><strong>{{ $tipo }}:</strong> {{ $valor }}</p>
            @endif
        @endforeach
    </div>
@endif
