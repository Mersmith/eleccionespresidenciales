@if (!empty($p_elemento) && $p_elemento['encuestas']->isNotEmpty())
    <div>
        @include('web.partials.titulo', [
            'p_contenido' => $p_elemento['titulo'],
            'p_alineacion' => 'left',
            'p_color' => '#000000',
        ])

        <div class="partials_contenedor_slider_encuesta">
            <!-- Swiper -->
            <div class="swiper SwiperSliderProducto-{{ $p_elemento['id'] }}">
                <div class="swiper-wrapper">
                    @foreach ($p_elemento['encuestas'] as $index => $item)
                        <div class="swiper-slide">
                            <div>
                                <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                    <div class="contenedor_imagen">
                                        <img src="{{ $item->eleccion->imagen_ruta }}" alt="">

                                        @if ($item->ya_finalizo)
                                            <span class="estado_finalizado">Finalizada</span>
                                        @else
                                            <span class="estado_activo">{{ $item->fecha_fin_formateada }}</span>
                                        @endif
                                    </div>
                                </a>
                                <div class="marca">{{ $item->provincia->nombre }}</div>
                                <div class="titulo">{{ $item->distrito->nombre }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <script>
            var swiper = new Swiper('.SwiperSliderProducto-{{ $p_elemento['id'] }}', {
                slidesPerView: 6,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.SwiperSliderProducto-{{ $p_elemento['id'] }} .swiper-button-next',
                    prevEl: '.SwiperSliderProducto-{{ $p_elemento['id'] }} .swiper-button-prev',
                },
                pagination: {
                    el: '.SwiperSliderProducto-{{ $p_elemento['id'] }} .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 6,
                    },
                    700: {
                        slidesPerView: 4,
                    },
                    0: {
                        slidesPerView: 2,
                    }
                }
            });
        </script>
    </div>
@endif
