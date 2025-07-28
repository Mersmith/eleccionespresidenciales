@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
<div class="g_contenedor_pagina">

    @include('web.partials.banner', ['p_elemento' => $data_baner_1])

    @include('web.partials.slider-principal', ['p_elemento' => $data_sliders_principal_1])

    <div class="g_centrar_pagina">

        @include('web.partials.aviso', [
        'p_elemento' => $data_candidatos_presidenciales,
        ])

        @include('web.partials.aviso', [
        'p_elemento' => $data_candidatos_alcaldia_lima,
        ])

        @include('web.partials.mostrador', [
        'p_elemento' => $data_partidos_politicos,
        ])

        @include('web.partials.temporizador', [
        'p_elemento' => $data_encuesta_presidencial,
        ])

        @include('web.partials.temporizador', [
        'p_elemento' => $data_encuesta_alcaldia_provincial_lima,
        ])

    </div>
</div>
@endsection
