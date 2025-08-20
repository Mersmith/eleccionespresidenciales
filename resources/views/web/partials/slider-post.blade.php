@if (!empty($p_elemento) && $p_elemento['posts']->isNotEmpty())

    <div class="g_card_panel">
        @include('web.partials.titulo', [
            'p_contenido' => $p_elemento['titulo'],
            'p_alineacion' => 'left',
        ])

        <div class="partials_contenedor_slider_post">
            <!-- Swiper -->
            <div class="swiper SwiperSliderPost-{{ $p_elemento['id'] }}">
                <div class="swiper-wrapper">
                    @foreach ($p_elemento['posts'] as $post)
                        <div class="swiper-slide">
                            <a href="{{ route('post', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                <div class="post_imagen_contenedor">
                                 
                                    <img src="{{ $post->image }}">
                                    <p class="titulo">{{ $post->meta_title }}</p>
                                    <p class="fecha">{{ $post->created_at->format('d M Y') }}</p>
                                    <p class="descripcion">{{ $post->meta_description }}</p>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <script>
            var swiper = new Swiper('.SwiperSliderPost-{{ $p_elemento['id'] }}', {
                slidesPerView: 3.5, // 👈 muestra 3 completos + un poco del siguiente
                spaceBetween: 10, // espacio entre slides
                navigation: {
                    nextEl: '.SwiperSliderPost-{{ $p_elemento['id'] }} .swiper-button-next',
                    prevEl: '.SwiperSliderPost-{{ $p_elemento['id'] }} .swiper-button-prev',
                },
             
                breakpoints: {
                    1024: {
                        slidesPerView: 4.5, // 👈 más grande en desktop
                        spaceBetween: 15,
                    },
                    700: {
                        slidesPerView: 3.2,
                        spaceBetween: 10,
                    },
                    0: {
                        slidesPerView: 2.2,
                        spaceBetween: 5,
                    }
                }
            });
        </script>
    </div>
@endif
