@if (!empty($p_elemento) && !empty($p_elemento->imagenes))
    <div class="partials_contenedor_grid">
        <div class="swiper SwiperGrid-{{ $p_elemento->id }}">
            <!-- SLIDER -->
            <div class="swiper-wrapper">
                @foreach ($p_elemento->imagenes as $elemento)
                    <div
                        class="swiper-slide {{ $elemento['width'] === 50 ? 'item_50' : ($elemento['width'] === 25 ? 'item_25' : '') }}">
                        <a href="{{ $elemento['link'] }}">
                            <img src="{{ $elemento['imagenComputadora'] }}" alt="" class="imagen_computadora" />
                            <img src="{{ $elemento['imagenMovil'] }}" alt="" class="imagen_movil" />
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
        var swiper = new Swiper('.SwiperGrid-{{ $p_elemento->id }}', {
            slidesPerView: 'auto',
            spaceBetween: 0,
            navigation: {
                nextEl: '.SwiperGrid-{{ $p_elemento->id }} .swiper-button-next',
                prevEl: '.SwiperGrid-{{ $p_elemento->id }} .swiper-button-prev',
            },
            pagination: {
                el: '.SwiperGrid-{{ $p_elemento->id }} .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1000: {
                    slidesPerView: 'auto', // Para pantallas mayores a 1000px
                },
                700: {
                    slidesPerView: 1, // Para pantallas entre 700px y 1000px
                },
                0: {
                    slidesPerView: 1, // Para pantallas menores a 700px
                }
            },
            /*on: {
                init: function() {
                    // Ajuste del ancho basado en la clase
                    var slides = document.querySelectorAll('.SwiperGrid-{{ $p_elemento->id }} .swiper-slide');
                    slides.forEach(function(slide) {
                        if (slide.classList.contains('item_50')) {
                            slide.style.width = '50%';
                        } else if (slide.classList.contains('item_25')) {
                            slide.style.width = '25%';
                        }
                    });
                }
            }*/
        });
    </script>
@endif
