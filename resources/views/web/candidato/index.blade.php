@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', $candidato_partido->nombre ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    $candidato_partido->descripcion ?:
    'VotaXmi es un sistema web especializado en encuestas y
    procesos electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $candidato_partido->foto ? url($candidato_partido->foto) :
    asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">
        <div class="g_centrar_pagina">

            <div class="g_pading_pagina g_gap_pagina">

                <div class="g_grid_pagina_2_columnas">
                    <!-- COLUMNA 1 -->
                    <div class="g_grid_columna_1">

                        <!-- PERFIL -->
                        @include('web.partials.perfil-candidato', [
                            'p_elemento' => $candidato_partido,
                        ])

                        <!-- VIDEO PRESENTACION -->
                        @if ($candidato_partido->video_presentacion)
                            @php
                                preg_match(
                                    '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([^\&\?\/]+)/',
                                    $candidato_partido->video_presentacion,
                                    $matches,
                                );
                                $videoId = $matches[1] ?? null;
                            @endphp

                            @if ($videoId)
                                <div class="g_video_container">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player"
                                        frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        @endif

                        <!-- ENCUESTA ACTIVA -->
                        @if ($candidato_encuesta_activa)
                            @include('web.partials.temporizador', [
                                'p_elemento' => $candidato_encuesta_activa,
                            ])
                        @endif

                        @if ($candidato_cargos)
                            @include('web.partials.candidatura-cargo', [
                                'p_elemento' => $candidato_cargos,
                            ])
                        @endif

                        @if ($candidato_encuestas_participaciones->count())
                            <div class="g_card_panel g_card_partial_column">
                                <h2 class="g_texto_nivel_6 g_texto_borde_izquierdo g_texto_subrayado">Úlimas participaciones
                                </h2>

                                @include('web.partials.lista-encuesta', [
                                    'p_elemento' => $candidato_encuestas_participaciones,
                                ])
                            </div>
                        @endif

                        <div class="g_card_panel g_card_partial_column">
                            @include('web.partials.social-share', [
                                'url' => url()->current(),
                                'title' => $candidato_partido->nombre ?? 'VotaXmi',
                                'description' =>
                                    $candidato_partido->descripcion ??
                                    'Participa y apoya a tu candidato favorito.',
                                'image' => $candidato_partido->foto
                                    ? url($candidato_partido->foto)
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
@endsection
