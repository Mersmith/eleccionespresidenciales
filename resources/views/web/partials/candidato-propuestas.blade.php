@if (
    !empty($datos) &&
        collect($datos)->filter(fn($items) => !empty($items) && collect($items)->filter(fn($i) => !empty($i['texto']))->isNotEmpty())->isNotEmpty())
    <div class="g_card_panel g_margin_bottom_20" x-data="{ abierto: null }">
        <h3 class="g_texto_nivel_4 mb-3">PROPUESTAS</h3>

        <div class="divide-y rounded-xl overflow-hidden bg-white">
            @foreach ($datos as $tema => $items)
                @php
                    // Filtrar solo propuestas con texto
                    $itemsConTexto = array_filter($items, fn($i) => !empty($i['texto']));
                @endphp

                @if (!empty($itemsConTexto))
                    @php
                        // Icono del primer ítem válido
                        $iconoTema = $itemsConTexto[array_key_first($itemsConTexto)]['icono'] ?? 'fa-circle-check';
                    @endphp

                    <div>
                        {{-- Botón del acordeón --}}
                        <button @click="abierto === {{ $loop->index }} ? abierto = null : abierto = {{ $loop->index }}"
                            class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold hover:bg-gray-100 transition">
                            <span>
                                <i class="fa-solid {{ $iconoTema }} mr-2"></i>
                                {{ $tema }}
                            </span>
                            <i class="fa-solid"
                                :class="abierto === {{ $loop->index }} ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>

                        {{-- Contenido --}}
                        <div x-show="abierto === {{ $loop->index }}" x-collapse>
                            <ul class="px-6 pb-4 space-y-2">
                                @foreach ($itemsConTexto as $item)
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-circle-check text-green-600 mt-1"></i>
                                        <span>{{ $item['texto'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
