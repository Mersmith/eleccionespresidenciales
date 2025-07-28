@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', 'Tendencias Market | Todos los productos que quieres están aquí!')
@section('descripcion', 'Tendencias Market')

@section('content')
<div class="g_contenedor_pagina">

    <div>
        <h2>
            DATOS DEL CANDIDATO
        </h2>

        <h3>{{$candidato_partido->nombre}} </h3>
        <p>{{$candidato_partido->descripcion}} </p>
        <img src="{{ $candidato_partido->foto}}" alt="" style="width: 80px" />
    </div>

    <br>

    @if($candidato_partido)
    <div>

        <h2>
            DATOS DEL PARTIDO
        </h2>

        <h3>{{$candidato_partido->partido->nombre}} </h3>
        <p>{{$candidato_partido->partido->descripcion}} </p>
        <img src="{{ $candidato_partido->partido->logo}}" alt="" style="width: 80px" />
    </div>
    @endif

    <br>

    @if($candidato_encuesta_activa)
    <div>
        <h2>
            ENCUESTA ACTIVA
        </h2>

        <h3>{{$candidato_encuesta_activa->nombre}} </h3>
        <p>{{$candidato_encuesta_activa->descripcion}} </p>
    </div>
    @endif

    <br>

    @if($candidato_encuestas_participaciones)
    <div>
        <h2>
            HISTORIAL ENCUESTA
        </h2>

        @foreach ($candidato_encuestas_participaciones as $index => $item)
        <li>
            <h3>{{$item->nombre}} </h3>
            <p>{{$item->descripcion}} </p>
            <br>
        </li>
        @endforeach
    </div>
    @endif

    <br>

    @if($candidato_cargos)
    <div>
        <h2>
            CARGOS DEL CANDIDATO
        </h2>

        <div class="">
            <!--TABLA CONTENIDO-->
            <div class="">
                <div class="">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Cargo</th>
                                <th>Elección</th>
                                <th>Partido</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidato_cargos as $index => $item)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td class="g_resaltar">{{ $item->cargo->nombre  }}</td>
                                <td>{{ $item->eleccion->nombre }}</td>
                                <td>{{ $item->partido->nombre ?? '-' }}</td>
                                <td>
                                    {{ $item->region->nombre ?? '-' }}
                                    {{ $item->provincia->nombre ?? '' }}
                                    {{ $item->distrito->nombre ?? '' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
