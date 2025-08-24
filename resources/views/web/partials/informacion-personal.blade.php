@if (!empty($datos))
    {{-- Información Personal --}}
    @if (collect($datos['personales'] ?? [])->filter(fn($v) => !empty($v))->isNotEmpty())
        <div class="g_card_panel g_margin_bottom_20">
            <h3 class="g_texto_nivel_4">INFORMACIÓN PERSONAL</h3>

            @foreach ($datos['personales'] as $campo => $valor)
                @if (!empty($valor))
                    <p><strong>{{ $campo }}:</strong> {{ $valor }}</p>
                @endif
            @endforeach
        </div>
    @endif

    {{-- Antecedentes --}}
    @if (collect($datos['antecedentes'] ?? [])->filter(fn($v) => !empty($v))->isNotEmpty())
        <div class="g_card_panel g_margin_bottom_20">
            <h3 class="g_texto_nivel_4">ANTECEDENTES</h3>

            @foreach ($datos['antecedentes'] as $tipo => $pdf)
                @if (!empty($pdf))
                    <p>
                        <strong>{{ $tipo }}:</strong>
                        <a href="{{ $pdf }}" target="_blank"
                            class="inline-block max-w-xs overflow-hidden text-ellipsis whitespace-nowrap align-middle text-gray-500 hover:text-gray-700">
                            <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i>
                            {{ $pdf }}
                        </a>
                    </p>
                @endif
            @endforeach
        </div>
    @endif
@endif
