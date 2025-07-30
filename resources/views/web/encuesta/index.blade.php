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
                        <div class="contendor_encuesta">
                            <div class="titulares">
                                <h4>ENCUESTA</h4>
                                <h3>{{ $encuesta->nombre }} </h3>
                                <p>
                                    <strong>Inicio:</strong> {{ $encuesta->fecha_inicio_formateada }} |
                                    <strong>Fin:</strong> {{ $encuesta->fecha_fin_formateada }}
                                </p>
                                <p><i class="fas fa-user-tie"></i> {{ $encuesta->cargo->nombre ?? '-' }}</p>

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

                                <div>
                                    <i class="fas fa-map-marker-alt"></i> {{ $ubicacion }}
                                </div>
                            </div>

                            @livewire('web.encuesta.encuesta-voto-livewire', ['encuesta_id' => $encuesta->id, 'candidatos' => $encuesta->candidatoCargos])

                            <a class="boton_resultado" href="{{ route('encuesta.resultado', ['id' => $encuesta->id, 'slug' => $encuesta->slug]) }}">
                                Ver resultados
                            </a>
                        </div>
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
