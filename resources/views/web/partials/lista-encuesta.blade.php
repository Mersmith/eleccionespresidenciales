@if (!empty($p_elemento))
    <div class="partials_contenedor_lista_encuesta">
        <h2 class="titulo_encuestas">Últimas encuestas donde participa</h2>

        @foreach ($p_elemento as $index => $item)
            <div class="encuesta_item">
                <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}" class="imagen_container">
                    <img src="{{ $item->eleccion->imagen_ruta }}" alt="Imagen" class="imagen_encuesta">
                    @if ($item->ya_finalizo)
                        <span class="estado_finalizado">Finalizada</span>
                    @else
                        <span class="estado_activo">{{ $item->fecha_fin_formateada }}</span>
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

                    <div class="ubicacion">
                        {{ $ubicacion }}
                    </div>

                    <h3 class="nombre_encuesta">{{ $item->nombre }}</h3>
                    <p class="cargo_encuesta"><strong>Cargo:</strong> {{ $item->cargo->nombre ?? '-' }}</p>

                    <p class="fechas_encuesta">
                        <strong>Inicio:</strong> {{ $item->fecha_inicio_formateada }} |
                        <strong>Fin:</strong> {{ $item->fecha_fin_formateada }}
                    </p>

                    <p class="descripcion_encuesta">{{ $item->descripcion }}</p>

                    <div class="ver_mas_container">
                        <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}"
                            class="ver_mas_btn">
                            Ver encuesta <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
