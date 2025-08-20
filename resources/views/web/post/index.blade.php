@extends('components.layouts.web.layout-ecommerce')

@section('tituloPagina', $post->titulo ?: 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion',
    $post->meta_description ?:
    'VotaXmi es un sistema web especializado en encuestas y procesos
    electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', $post->image ? url($post->image) : asset('assets/images/imagen-defecto.jpg'))

@section('content')
    <div class="g_contenedor_pagina">
        <div class="g_centrar_pagina">
            <div class="g_pading_pagina g_gap_pagina">

                <div class="g_grid_pagina_2_columnas">

                    <!-- COLUMNA 1: Post principal -->
                    <div class="g_grid_columna_1">
                        <article class="g_card_panel contenedor_post">

                            <!-- Título -->
                            <h1 class="titulo">{{ $post->titulo }}</h1>
                            @php
                                $autorNombre = 'Desconocido';
                                $cargo = null;
                                $autorImagen = null;
                                $url = '#';

                                if ($post->candidato_id) {
                                    $autorNombre = $post->candidato->nombre;
                                    $autorImagen = $post->candidato->foto;
                                    $cargo = $post->candidato->partido->nombre ?? null;
                                    $url = route('candidato', [
                                        'id' => $post->candidato->id,
                                        'slug' => $post->candidato->slug,
                                    ]);
                                } elseif ($post->partido_id) {
                                    $autorNombre = $post->partido->nombre;
                                    $autorImagen = $post->partido->logo;
                                    $url = route('partido', [
                                        'id' => $post->partido->id,
                                        'slug' => $post->partido->slug,
                                    ]);
                                } elseif ($post->alianza_id) {
                                    $autorNombre = $post->alianza->nombre;
                                    $autorImagen = $post->alianza->logo;
                                    $url = route('alianza', [
                                        'id' => $post->alianza->id,
                                        'slug' => $post->alianza->slug,
                                    ]);
                                }
                            @endphp
                            <!-- AUTOR -->
                            <a class="contenedor_autor" href=" {{ $url }}">

                                <div class="imagen">
                                    @if ($autorImagen)
                                        <img src="{{ $autorImagen }}" alt="{{ $autorNombre }}">
                                    @else
                                        <img src="{{ asset('assets/images/partido/partido-1.jpg') }}">
                                    @endif
                                </div>

                                <div class="datos">
                                    <p> {{ $autorNombre }}</p>
                                    @if ($cargo)
                                        <span> {{ $cargo }}</span>
                                    @endif
                                </div>
                            </a>

                            <!-- FECHA -->
                            <div class="fecha">
                                <i class="fa-solid fa-clock"></i>
                                @php
                                    use Carbon\Carbon;
                                    setlocale(LC_TIME, 'es_ES.UTF-8'); // Establece español
                                    $fecha = Carbon::parse($post->created_at)->translatedFormat('d M Y');
                                @endphp

                                <span>{{ $fecha }}</span>
                            </div>

                            @php
                                // Reemplaza todos los <oembed> por <iframe>
                                $contenido = preg_replace_callback(
                                    '/<oembed url="([^"]+)"><\/oembed>/i',
                                    function ($matches) {
                                        $url = $matches[1];

                                        // Extraer el ID del video de YouTube
                                        if (preg_match('/(?:v=|\/)([a-zA-Z0-9_-]{11})/', $url, $id)) {
                                            $videoId = $id[1];
                                            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' .
                                                $videoId .
                                                '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                        }

                                        return '';
                                    },
                                    $post->content,
                                );
                            @endphp

                            <div class="contenido_post">
                                {!! $contenido !!}
                            </div>

                        </article>

                        <div class="g_card_panel g_card_partial_column">
                            @include('web.partials.social-share', [
                                'url' => url()->current(),
                                'title' => $post->titulo ?? 'VotaXmi',
                                'description' =>
                                    $post->meta_description ??
                                    'Participa y apoya a tu candidato favorito.',
                                'image' => $post->image
                                    ? url($post->image)
                                    : asset('assets/images/imagen-defecto.jpg'),
                            ])
                        </div>
                    </div>

                    <!-- COLUMNA 2: Sidebar o contenido adicional -->
                    <div class="g_grid_columna_2">
                        @if ($otrosPosts->count())
                            <div class="contenedor_lista_post">
                                <h3 class="g_texto_nivel_1">Más publicaciones </h3>

                                @foreach ($otrosPosts as $post)
                                    <div class="post_item">
                                        <a href="{{ route('post', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                            <img src="{{ $post->image }}">
                                            <p class="titulo">{{ $post->meta_title }}</p>
                                            <p class="fecha">{{ $post->created_at->format('d M Y') }}</p>
                                            <p class="descripcion">{{ $post->meta_description }}</p>
                                        </a>
                                    </div>
                                @endforeach

                                <!-- links de paginación -->
                                <div class="paginacion">
                                    {{ $otrosPosts->links() }}
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
