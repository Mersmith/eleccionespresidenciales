<div class="partials_contenedor_columna_publicidad">
    @if (isset($anuncios) && $anuncios->count())
        @foreach ($anuncios as $anuncio)
            <div class="contenido_publicitario">
                <a href="{{ $anuncio->link }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $anuncio->url_imagen }}" alt="{{ $anuncio->nombre }}" />
                </a>
            </div>
        @endforeach
    @else
        <div class="contenido_publicitario">
            <a href="">
                <img src="{{ asset('assets/images/anuncio/anuncio-1.jpg') }}" />
            </a>
        </div>

        <div class="contenido_publicitario">
            <a href="">
                <img src="{{ asset('assets/images/anuncio/anuncio-2.jpg') }}" />
            </a>
        </div>

        <div class="contenido_publicitario">
            <a href="">
                <img src="{{ asset('assets/images/anuncio/anuncio-1.jpg') }}" />
            </a>
        </div>
    @endif
</div>