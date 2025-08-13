@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    'VotaXmi es un sistema web especializado en encuestas y procesos electorales para elecciones
    presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">

        @include('web.partials.banner', ['p_elemento' => $data_baner_1])

        @include('web.partials.slider-principal', ['p_elemento' => $data_sliders_principal_1])

        <div class="g_centrar_pagina">

            <div class="g_pading_pagina g_gap_pagina g_margin_top_40">

                @include('web.partials.slider-candidato', [
                    'p_elemento' => $data_candidatos_presidenciales,
                ])

                @include('web.partials.temporizador', [
                    'p_elemento' => $data_encuesta_presidencial,
                ])

                @include('web.partials.banner', ['p_elemento' => $data_banner_2])

                @include('web.partials.slider-candidato', [
                    'p_elemento' => $data_candidatos_alcaldia_lima,
                ])

                @include('web.partials.temporizador', [
                    'p_elemento' => $data_encuesta_alcaldia_provincial_lima,
                ])

                @include('web.partials.banner', ['p_elemento' => $data_banner_3])

                @include('web.partials.slider-encuesta', [
                    'p_elemento' => $data_encuestas_alcaldia_distritos_lima,
                ])

                @include('web.partials.mostrador', [
                    'p_elemento' => $data_partidos_politicos,
                ])

                @include('web.partials.banner', ['p_elemento' => $data_banner_4])

                @include('web.partials.mostrador-alianza', [
                    'p_elemento' => $data_alianzas_electorales,
                ])

            </div>

        </div>
    </div>
@endsection
