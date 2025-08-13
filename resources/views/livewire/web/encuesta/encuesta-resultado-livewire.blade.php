@section('tituloPagina', $encuesta->nombre ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    $encuesta->descripcion ?:
    'VotaXmi es un sistema web especializado en encuestas y procesos
    electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $encuesta->imagen_url ? url($encuesta->imagen_url) : asset('assets/images/imagen-defecto.jpg'))

<div class="g_contenedor_pagina">

    @include('web.partials.banner', ['p_elemento' => $data_baner_1])

    <div class="g_centrar_pagina">

        <div class="g_pading_pagina g_gap_pagina">

            @php
                $totalVotos = $resultados->sum('votos');
            @endphp

            <div class="g_card_panel">
                <div>
                    <h4 class="g_texto_nivel_6">ENCUESTA</h4>
                    {{-- <h3 class="g_texto_nivel_6">{{ $encuesta->nombre }} </h3> --}}
                    <p class="g_texto_nivel_2">
                        <strong>Inicio:</strong> {{ $encuesta->fecha_inicio_formateada }} |
                        <strong>Fin:</strong> {{ $encuesta->fecha_fin_formateada }}
                    </p>
                    <p class="g_texto_nivel_1"><i class="fas fa-user-tie"></i>
                        {{ $encuesta->cargo->nombre ?? '-' }}</p>

                    @php
                        $ubicacion = collect([
                            $encuesta->pais?->nombre,
                            $encuesta->region?->nombre,
                            $encuesta->provincia?->nombre,
                            $encuesta->distrito?->nombre,
                        ])
                            ->filter()
                            ->join(' / ');
                    @endphp

                    <span class="g_texto_nivel_3">
                        <i class="fas fa-map-marker-alt"></i> {{ $ubicacion }}
                    </span>
                </div>

                <div class="grafico_vertical">
                    <p class="g_texto_nivel_3">Total de votos: <strong>{{ $totalVotos }}</strong></p>

                    <div class="grafico_barras_scroll g_scroll">
                        <div class="grafico">
                            @foreach ($resultados as $item)
                                @php
                                    $porcentaje = $totalVotos > 0 ? round(($item['votos'] / $totalVotos) * 100, 2) : 0;
                                @endphp
                                <div class="barra_container">
                                    <div class="barra" style="height: {{ $porcentaje }}%">
                                        <div class="foto_contenedor">
                                            @if (!empty($item['candidato_foto']))
                                                <img src="{{ $item['candidato_foto'] }}" alt="Candidato"
                                                    class="foto-candidato">
                                            @else
                                                <img src="{{ asset('assets/images/partido/partido-1.jpg') }}"
                                                    alt="" class="foto-candidato">
                                            @endif

                                            @if (!empty($item['partido_foto']))
                                                <img src="{{ $item['partido_foto'] }}" alt="Partido"
                                                    class="logo-partido">
                                            @else
                                                <img src="{{ asset('assets/images/partido/partido-1.jpg') }}"
                                                    alt="" class="logo-partido">
                                            @endif

                                            @if (!empty($item['numero']))
                                                <div class="numero_candidato">
                                                    <span>{{ $item['numero'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pie_datos_candidato">
                                            <div class="porcentaje">{{ $porcentaje }}%</div>
                                            <div class="nombre"> {{ $item['candidato_nombre'] }}</div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="g_grid_pagina_2_columnas">
                <!-- COLUMNA 1 -->
                <div class="g_grid_columna_1">
                    <div class="g_card_panel">
                        <div class="grafico_horizontal">
                            <p class="g_texto_nivel_3">Total de votos: <strong>{{ $totalVotos }}</strong></p>

                            @foreach ($resultados as $item)
                                @php
                                    $porcentaje = $totalVotos > 0 ? round(($item['votos'] / $totalVotos) * 100, 2) : 0;
                                @endphp
                                <div class="candidato-item">
                                    <div class="foto_contenedor">
                                        @if (!empty($item['candidato_foto']))
                                            <img src="{{ $item['candidato_foto'] }}" alt="Candidato"
                                                class="foto-candidato">
                                        @else
                                            <img src="{{ asset('assets/images/partido/partido-1.jpg') }}"
                                                alt="" class="foto-candidato">
                                        @endif

                                        @if (!empty($item['partido_foto']))
                                            <img src="{{ $item['partido_foto'] }}" alt="Partido" class="logo-partido">
                                        @else
                                            <img src="{{ asset('assets/images/partido/partido-1.jpg') }}"
                                                alt="" class="logo-partido">
                                        @endif

                                        @if (!empty($item['numero']))
                                            <div class="numero_candidato">
                                                <span>{{ $item['numero'] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="info_candidato">
                                        <div class="nombre_candidato">{{ $item['candidato_nombre'] }}</div>
                                        <div class="nombre_partido">{{ $item['partido_nombre'] }}</div>
                                        <div class="barra_voto">
                                            <div class="barra_progreso" style="width: {{ $porcentaje }}%"></div>
                                        </div>
                                    </div>
                                    <div class="votos_dato">
                                        <div class="cantidad_votos">{{ $item['votos'] }} votos</div>
                                        <div class="porcentaje">{{ $porcentaje }}%</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a class="boton_siguiente"
                            href="{{ route('encuesta', ['id' => $encuesta->id, 'slug' => $encuesta->slug]) }}">
                            Ver encuesta
                        </a>

                        <br>

                        @include('web.partials.social-share', [
                            'url' => url()->current(),
                            'title' => $encuesta->nombre ?? 'VotaXmi',
                            'description' =>
                                $encuesta->descripcion ?? 'Participa y apoya a tu candidato favorito.',
                            'image' => $encuesta->imagen_url
                                ? url($encuesta->imagen_url)
                                : asset('assets/images/imagen-defecto.jpg'),
                        ])
                    </div>
                </div>

                <!-- COLUMNA 2 -->
                <div class="g_grid_columna_2">
                    @include('web.partials.columna-publicidad')
                </div>

            </div>
        </div>
    </div>
</div>
