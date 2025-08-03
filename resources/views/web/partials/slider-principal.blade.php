@if (!empty($p_elemento) && !empty($p_elemento->imagenes))
    <div class="g_centrar_contenedor">
        <div class="partials_contenedor_slider_principal">
            <!-- Swiper -->
            <div class="swiper SwiperSliderPrincipal-{{ $p_elemento->id }} ">
                <div class="swiper-wrapper">
                    @foreach ($p_elemento->imagenes as $index => $slide)
                        <div class="swiper-slide">
                            <a href="{{ $slide['link'] }}">
                                <img src="{{ $slide['imagen_computadora'] }}" alt="" class="imagen_computadora" />
                                <img src="{{ $slide['imagen_movil'] }}" alt="" class="imagen_movil" />
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".SwiperSliderPrincipal-{{ $p_elemento->id }}", {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: {{ count($p_elemento->imagenes) > 1 ? 'true' : 'false' }},
            pagination: {
                el: ".SwiperSliderPrincipal-{{ $p_elemento->id }} .swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".SwiperSliderPrincipal-{{ $p_elemento->id }} .swiper-button-next",
                prevEl: ".SwiperSliderPrincipal-{{ $p_elemento->id }} .swiper-button-prev",
            },
        });
    </script>
@endif
