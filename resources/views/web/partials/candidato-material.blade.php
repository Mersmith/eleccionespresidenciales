@if (!empty($datos) && collect($datos)->filter(fn($link) => !empty($link))->isNotEmpty())
    <div class="g_card_panel g_margin_bottom_20">
        <h3 class="g_texto_nivel_4">MATERIAL GRÁFICO</h3>

        @foreach ($datos as $tipo => $link)
            @if (!empty($link))
                <p>
                    <strong>{{ $tipo }}:</strong>
                    <a href="{{ $link }}" target="_blank" class="text-gray-500 inline-block max-w-xs overflow-hidden text-ellipsis whitespace-nowrap align-middle">
                        <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i>
                        {{ $link }}
                    </a>
                </p>
            @endif
        @endforeach
    </div>
@endif
