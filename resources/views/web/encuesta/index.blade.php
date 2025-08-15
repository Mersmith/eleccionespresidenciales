@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', $encuesta->nombre ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    $encuesta->descripcion ?:
    'VotaXmi es un sistema web especializado en encuestas y procesos
    electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $encuesta->imagen_url ? url($encuesta->imagen_url) : asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">

        @include('web.partials.banner', ['p_elemento' => $data_baner_1])

        <div class="g_centrar_pagina">

            <div class="g_pading_pagina g_gap_pagina">

                <div class="g_grid_pagina_2_columnas">
                    <!-- COLUMNA 1 -->
                    <div class="g_grid_columna_1">
                        <div class="g_card_panel g_card_flex_column">
                            <div class="g_centrar_elementos">
                                @if ($estado_encuesta)
                                    <span class="g_etiqueta g_etiqueta_desactivo">Finalizó</span>
                                @else
                                    <span class="g_etiqueta g_etiqueta_activo">Abierto</span>
                                @endif

                                <h4 class="g_texto_nivel_6">ENCUESTA</h4>
                                {{-- <h3 class="g_texto_nivel_6">{{ $encuesta->nombre }} </h3> --}}
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

                                <span class="g_texto_nivel_4">
                                    <i class="fas fa-map-marker-alt"></i> {{ $ubicacion }}
                                </span>

                                @if (!Auth::check())
                                    <span class="g_ver_mas_btn">Primero inicia sesión con Google o Facebook, para que puedas votar.</span>
                                    <span class="g_ver_mas_btn">¡Selecciona un candidato y vota!</span>
                                @endif
                            </div>

                            @livewire('web.encuesta.encuesta-voto-livewire', ['encuesta_id' => $encuesta->id, 'candidatos' => $encuesta->candidatoCargos, 'estado_encuesta' => $estado_encuesta])

                            <a class="boton_siguiente"
                                href="{{ route('encuesta.resultado', ['id' => $encuesta->id, 'slug' => $encuesta->slug]) }}">
                                Ver resultados
                            </a>

                            <br>

                            @include('web.partials.social-share', [
                                'url' => url()->current(),
                                'title' => $encuesta->nombre ?? 'VotaXmi',
                                'description' =>
                                    $encuesta->descripcion ?? 'Participa y apoya a tu candidato favorito.',
                                'image' => $encuesta->imagen_url
                                    ? url($encuesta->imagen_url)
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
