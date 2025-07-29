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

                        @if ($candidato_encuestas_participaciones)
                            <div>
                                <h2>
                                    HISTORIAL ENCUESTA
                                </h2>

                                @foreach ($candidato_encuestas_participaciones as $index => $item)
                                    <li>
                                        <h3>{{ $item->nombre }} </h3>
                                        <p>{{ $item->descripcion }} </p>
                                        <br>
                                    </li>
                                @endforeach
                            </div>
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
