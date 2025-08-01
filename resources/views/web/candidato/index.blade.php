@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

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
