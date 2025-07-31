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
