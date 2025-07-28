@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
<div class="g_contenedor_pagina">

    <div>
        <h2>
            DATOS DEL CANDIDATO
        </h2>

        <h3>{{$encuesta->nombre}} </h3>
        <p>{{$encuesta->descripcion}} </p>
        <img src="{{ $encuesta->eleccion?->imagen_ruta }}" alt="" style="width: 80px" />
    </div>

    <br>

    <h2>VOTAR</h2>
    
    @livewire('web.encuesta.encuesta-voto-livewire', ['encuesta_id' => $encuesta->id, 'candidatos' => $encuesta->candidatoCargos])
    
    <br>

    <h2>VER RESULTADOS</h2>

    <a href="{{ route('encuesta.resultado', ['id' => $encuesta->id, 'slug' => $encuesta->slug]) }}">CLICK ACA</a>
</div>
@endsection
