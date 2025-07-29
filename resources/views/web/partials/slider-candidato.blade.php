@if (!empty($p_elemento) && $p_elemento['candidatos']->isNotEmpty())

    <div>
        @include('web.partials.titulo', [
            'p_contenido' => $p_elemento['titulo'],
            'p_alineacion' => 'left',
            'p_color' => '#000000',
        ])

        <div class="partials_contenedor_slider_candidato">
            <!-- Swiper -->
            <div class="swiper SwiperSliderCandidato-{{ $p_elemento['id'] }}">
                <div class="swiper-wrapper">
                    @foreach ($p_elemento['candidatos'] as $postulacion)
                        <div class="swiper-slide">
                            <a href="{{ route('candidato', ['id' => $postulacion->candidato->id, 'slug' => $postulacion->candidato->slug]) }}">
                                <div class="candidato_imagen_contenedor">
                                    <img class="imagen_candidato" src="{{ $postulacion->candidato->foto }}"
                                        alt="" />
                                    <img class="logo_partido" src="{{ $postulacion->candidato->partido->logo }}"
                                        alt="" />
                                </div>
                                <p>{{ $postulacion->candidato->nombre }}</p>
                                <span>{{ $postulacion->candidato->partido->nombre }}</span>
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
            var swiper = new Swiper('.SwiperSliderCandidato-{{ $p_elemento['id'] }}', {
                slidesPerView: 4,
                spaceBetween: 0,
                navigation: {
                    nextEl: '.SwiperSliderCandidato-{{ $p_elemento['id'] }} .swiper-button-next',
                    prevEl: '.SwiperSliderCandidato-{{ $p_elemento['id'] }} .swiper-button-prev',
                },
                pagination: {
                    el: '.SwiperSliderCandidato-{{ $p_elemento['id'] }} .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 5,
                    },
                    700: {
                        slidesPerView: 3,
                    },
                    0: {
                        slidesPerView: 2,
                    }
                }
            });
        </script>
    </div>
@endif
