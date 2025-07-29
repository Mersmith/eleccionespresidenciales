@if (!empty($p_elemento))
        <div class="partials_contenedor_lista_encuesta">
            <h2 class="titulo_encuestas">Últimas encuestas donde participa</h2>

            @foreach ($p_elemento as $index => $item)
                <div class="encuesta_item">
                    <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}"
                        class="imagen_container">
                        <img src="{{ $item->eleccion->imagen_ruta }}" alt="Imagen" class="imagen_encuesta">
                        @if ($item->ya_finalizo)
                            <span class="estado_finalizado">Finalizada</span>
                        @else
                            <span class="estado_activo">{{ $item->fecha_fin_formateada }}</span>
                        @endif
                    </a>

                    <div class="detalle_encuesta">
                        <div class="ubicacion">
                            <span>{{ $item->pais?->nombre }}</span> /
                            <span>{{ $item->region?->nombre }}</span> /
                            <span>{{ $item->provincia?->nombre }}</span> /
                            <span>{{ $item->distrito?->nombre }}</span>
                        </div>

                        <h3 class="nombre_encuesta">{{ $item->nombre }}</h3>
                        <p class="descripcion_encuesta">{{ $item->descripcion }}</p>
                    </div>
                </div>
            @endforeach
        </div>
@endif
