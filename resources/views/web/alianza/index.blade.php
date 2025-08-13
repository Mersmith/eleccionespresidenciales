@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', $alianza->nombre ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion', $alianza->descripcion ?: 'VotaXmi es un sistema web especializado en encuestas y procesos
    electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $alianza->logo ? url($alianza->logo) : asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">
        <div class="g_centrar_pagina">

            <div class="g_pading_pagina g_gap_pagina">

                <div class="g_grid_pagina_2_columnas">
                    <!-- COLUMNA 1 -->
                    <div class="g_grid_columna_1">
                        <!-- PERFIL -->
                        @include('web.partials.perfil-partido', [
                            'p_elemento' => $alianza,
                        ])

                        <div class="g_card_panel">
                            @include('web.partials.mostrador', [
                                'p_elemento' => $alianza,
                            ])
                        </div>

                        @include('web.partials.lista-candidato', [
                            'p_elemento' => $candidatos_presidenciales,
                            'p_titulo' => 'Candidaturas presidencial',
                        ])

                        <!-- ENCUESTA ACTIVA -->
                        @include('web.partials.temporizador', [
                            'p_elemento' => $encuesta_presidencial_activa,
                        ])

                        <div class="g_card_panel g_card_partial_column">
                            @include('web.partials.social-share', [
                                'url' => url()->current(),
                                'title' => $alianza->nombre ?? 'VotaXmi',
                                'description' =>
                                    $alianza->descripcion ?? 'Participa y apoya a tu candidato favorito.',
                                'image' => $alianza->logo
                                    ? url($alianza->logo)
                                    : asset('assets/images/imagen-defecto.jpg'),
                            ])
                        </div>
                    </div>

                    <!-- COLUMNA 2 -->
                    <div class="g_grid_columna_2">
                        @include('web.partials.columna-publicidad', ['anuncios' => $anuncios])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
