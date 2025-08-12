@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', $partido->nombre ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    $partido->descripcion ?:
    'VotaXmi es un sistema web especializado en encuestas y procesos
    electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $partido->logo ? url($partido->logo) : asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">
        <div class="g_centrar_pagina">

            <div class="g_pading_pagina g_gap_pagina">

                <div class="g_grid_pagina_2_columnas">
                    <!-- COLUMNA 1 -->
                    <div class="g_grid_columna_1">
                        <!-- PERFIL -->
                        @include('web.partials.perfil-partido', [
                            'p_elemento' => $partido,
                        ])

                        @include('web.partials.lista-candidato', [
                            'p_elemento' => $candidatos_presidenciales,
                            'p_titulo' => 'Candidaturas presidencial',
                        ])

                        <!-- ENCUESTA ACTIVA -->
                        @include('web.partials.temporizador', [
                            'p_elemento' => $encuesta_presidencial_activa,
                        ])

                        @include('web.partials.lista-candidato', [
                            'p_elemento' => $candidatos_alcaldia_lima,
                            'p_titulo' => 'Candidaturas alcaldía Lima',
                        ])

                        <div class="g_card_panel g_card_partial_column">
                            @include('web.partials.social-share', [
                                'url' => url()->current(),
                                'title' => $partido->nombre ?? 'VotaXmi',
                                'description' =>
                                    $partido->descripcion ??
                                    'Participa y apoya a tu candidato favorito.',
                                'image' => $partido->logo
                                    ? url($partido->logo)
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
