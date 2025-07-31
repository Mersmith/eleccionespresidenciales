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

                        <div class="partials_contendor_encuesta">
                            <div class="titulares">
                                <h4 class="g_texto_nivel_6">ENCUESTA</h4>
                                {{--<h3 class="g_texto_nivel_6">{{ $encuesta->nombre }} </h3>--}}
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

                            @livewire('web.encuesta.encuesta-voto-livewire', ['encuesta_id' => $encuesta->id, 'candidatos' => $encuesta->candidatoCargos])

                            <a class="boton_siguiente"
                                href="{{ route('encuesta.resultado', ['id' => $encuesta->id, 'slug' => $encuesta->slug]) }}">
                                Ver resultados
                            </a>
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
