@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
<div class="g_contenedor_pagina">



    @if($partido)
    <div>

        <h2>
            DATOS DEL PARTIDO
        </h2>

        <h3>{{$partido->nombre}} </h3>
        <p>{{$partido->descripcion}} </p>
        <img src="{{ $partido->logo}}" alt="" style="width: 80px" />
    </div>
    @endif

    <br>

    @if($candidatos_presidenciales)
    <div>
        <h2>
            CANDIDATOS A LA PRESIDENCIA
        </h2>

        @foreach ($candidatos_presidenciales as $index => $item)
        <li>
            <h3>{{$item->nombre}} </h3>
            <p>{{$item->descripcion}} </p>
            <br>
        </li>
        @endforeach
    </div>
    @endif

    <br>


    @if($candidatos_presidenciales)
    <div>
        <h2>
            CANDIDATOS A LA ALCALDIA DE LIMA
        </h2>

        @foreach ($candidatos_alcaldia_lima as $index => $item)
        <li>
            <h3>{{$item->nombre}} </h3>
            <p>{{$item->descripcion}} </p>
            <br>
        </li>
        @endforeach
    </div>
    @endif

    <br>

    @if($encuesta_presidencial_activa)
    <div>
        <h2>
            ENCUESTA ACTIVA
        </h2>

        <h3>{{$encuesta_presidencial_activa->nombre}} </h3>
        <p>{{$encuesta_presidencial_activa->descripcion}} </p>
    </div>
    @endif

    <br>
</div>
@endsection
