@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
<div class="g_contenedor_pagina">

    @include('web.partials.banner')


    @include('web.partials.slider-principal')

    <div class="g_centrar_pagina">

        <div>
            <h2>Presidentes</h2>
            @foreach ($data_candidatos_presidenciales as $postulacion)
            @if ($postulacion && $postulacion->candidato)
            <div>
                <strong>{{ $postulacion->candidato->nombre }}</strong><br>

                @if ($postulacion->partido)
                Partido: {{ $postulacion->partido->nombre }}
                @else
                Partido: Sin partido
                @endif
                <br>

                @if ($postulacion->candidato->foto)
                <img src="{{ asset('storage/' . $postulacion->candidato->foto) }}" width="100">
                @endif
            </div>
            @endif
            @endforeach
        </div>


        <div>
            <h2>Lima</h2>

            @foreach ($data_candidatos_alcaldia_lima as $postulacion)
                @if ($postulacion && $postulacion->candidato)
                <div>
                    <strong>{{ $postulacion->candidato->nombre }}</strong><br>
                
                    @if ($postulacion->partido)
                    Partido: {{ $postulacion->partido->nombre }}
                    @else
                    Partido: Sin partido
                    @endif
                    <br>
                
                    @if ($postulacion->candidato->foto)
                    <img src="{{ asset('storage/' . $postulacion->candidato->foto) }}" width="100">
                    @endif
                </div>
                @endif
            @endforeach
        </div>


    </div>
</div>
@endsection
