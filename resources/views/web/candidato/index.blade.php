@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
    <div class="contenedor_pagina_candidato">
        <div class="centrar">
            <div class="contenedor_bloque">
                <div class="grid_pagina_candidato">
                    <!-- INFORMACION -->
                    <div class="columna_informacion">
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
                            @include('web.partials.lista-encuesta', [
                                'p_elemento' => $candidato_encuestas_participaciones,
                            ])
                        @endif

                    </div>

                    <!-- PUBLICIDAD -->
                    <div class="columna_publicidad">
                        @include('web.partials.columna-publicidad')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
