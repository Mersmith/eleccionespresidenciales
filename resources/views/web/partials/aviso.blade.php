@if (!empty($p_elemento) && !empty($p_elemento->imagenes))
    <div class="partials_contenedor_aviso">
        <!-- Swiper -->
        <div class="swiper SwiperAviso-{{ $p_elemento->id }}">
            <div class="swiper-wrapper">
                @foreach ($p_elemento->imagenes as $elemento)
                    <div class="swiper-slide">
                        <a href="{{ $elemento['link'] }}">
                            <img src="{{ $elemento['imagen'] }}" alt="" />
                            @if ($elemento['titulo'])
                                <p>{{ $elemento['titulo'] }}</p>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <script>
        var swiper = new Swiper('.SwiperAviso-{{ $p_elemento->id }}', {
            slidesPerView: 4,
            spaceBetween: 0,
            navigation: {
                nextEl: '.SwiperAviso-{{ $p_elemento->id }} .swiper-button-next',
                prevEl: '.SwiperAviso-{{ $p_elemento->id }} .swiper-button-prev',
            },
            pagination: {
                el: '.SwiperAviso-{{ $p_elemento->id }} .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                },
                700: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                }
            }
        });
    </script>
@endif
