@if (!empty($p_elemento))
    <div class="partials_contenedor_lista_encuesta g_card_panel">
        <h2 class="g_texto_nivel_6 g_texto_borde_izquierdo g_texto_subrayado">Úlimas participaciones</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="encuesta_item">
                <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}" class="imagen_container">
                    <img src="{{ $item->eleccion->imagen_ruta }}" alt="Imagen" class="imagen_encuesta">
                    @if ($item->ya_finalizo)
                        <span class="g_etiqueta g_etiqueta_desactivo">Finalizada</span>
                    @else
                        <span class="g_etiqueta g_etiqueta_activo">{{ $item->fecha_fin_formateada }}</span>
                    @endif
                </a>

                <div class="detalle_encuesta">
                    @php
                        $ubicacion = collect([
                            $item->pais?->nombre,
                            $item->region?->nombre,
                            $item->provincia?->nombre,
                            $item->distrito?->nombre,
                        ])
                            ->filter()
                            ->join(' / ');
                    @endphp

                    <div class="g_texto_nivel_3">
                        {{ $ubicacion }}
                    </div>

                    <h3 class="g_texto_nivel_4">{{ $item->nombre }}</h3>
                    <p class="g_texto_nivel_2"><strong>Cargo:</strong> {{ $item->cargo->nombre ?? '-' }}</p>

                    <p class="g_texto_nivel_2">
                        <strong>Inicio:</strong> {{ $item->fecha_inicio_formateada }} |
                        <strong>Fin:</strong> {{ $item->fecha_fin_formateada }}
                    </p>

                    <p class="g_texto_descripcion">{{ $item->descripcion }}</p>

                    <div class="ver_mas_container">
                        <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}"
                            class="g_ver_mas_btn">
                            Ver encuesta <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
