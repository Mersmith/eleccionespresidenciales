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
                        @include('web.partials.perfil-partido', [
                            'p_elemento' => $partido,
                        ])

                        @include('web.partials.lista-candidato', [
                            'p_elemento' => $candidatos_presidenciales,
                        ])

                        @include('web.partials.lista-candidato', [
                            'p_elemento' => $candidatos_alcaldia_lima,
                        ])

                        <!-- ENCUESTA ACTIVA -->
                        @include('web.partials.temporizador', [
                            'p_elemento' => $encuesta_presidencial_activa,
                        ])
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
