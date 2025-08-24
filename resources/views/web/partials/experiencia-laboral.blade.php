@if (!empty($datos) && collect($datos)->filter(fn($items) => collect($items)->filter()->isNotEmpty())->isNotEmpty())
    <div class="g_card_panel g_margin_bottom_20">
        <h3 class="g_texto_nivel_4">EXPERIENCIA LABORAL</h3>

        @foreach ($datos as $tipo => $items)
            @if (!empty($items) && collect($items)->filter()->isNotEmpty())
                <h4 class="g_texto_nivel_1">{{ $tipo }}</h4>
                <ul>
                    @foreach ($items as $item)
                        @if (!empty($item))
                            <li>
                                <i class="fa-solid fa-briefcase"></i> {{ $item }}
                            </li>
                        @endif
                    @endforeach
                </ul>
                <br>
            @endif
        @endforeach
    </div>
@endif
