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
                        <!-- PERFIL -->
                        @include('web.partials.perfil-partido', [
                            'p_elemento' => $alianza,
                        ])

                        <ul>
                            @foreach ($alianza->partidos as $item)
                                <a href="{{ route('partido', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                    <!-- IMAGENES -->
                                    <img src="{{ $item->logo }}" alt="" style="width: 150px;" />
                                    <p class="g_texto_nivel_5">{{ $item->nombre }}</p>
                                </a>
                            @endforeach
                        </ul>
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
