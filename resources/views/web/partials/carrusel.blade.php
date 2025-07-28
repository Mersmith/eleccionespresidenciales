@if (!empty($p_elementos))
    <div class="partials_contenedor_carrusel">
        <!-- IMAGEN SELECCIONADA -->
        <div class="partials_contenedor_carrusel_cabecera">
            <div class="swiper swiperCabecera">
                <div class="swiper-wrapper contenedor_seleccionado">
                    @foreach ($p_elementos as $index => $imagen)
                        <div class="swiper-slide">
                            <div class="contenedor_imagen">
                                <img src="{{ $imagen->url }}" alt="" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- SLIDER THUMBNAILS -->
        <div class="partials_contenedor_carrusel_pie">
            <div class="swiper swiperThumbnails">
                <div class="swiper-wrapper contenedor_seleccionado">
                    @foreach ($p_elementos as $index => $imagen)
                        <div class="swiper-slide">
                            <div class="contenedor_imagen">
                                <img src="{{ $imagen->url }}" alt="" />
                            </div>
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
        var swiperThumbnails, swiperCabecera;

        function initializeSwipers() {

            var slidesPerView = 4; // Valor por defecto para menor a 500px

            if (window.innerWidth > 1000) {
                slidesPerView = 5;
            } else if (window.innerWidth > 800) {
                slidesPerView = 4;
            } else if (window.innerWidth > 500) {
                slidesPerView = 4;
            }

            swiperThumbnails = new Swiper(".swiperThumbnails", {
                direction: window.innerWidth > 1000 ? 'vertical' : 'horizontal',
                slidesPerView: slidesPerView,
                spaceBetween: 10,
                loop: false,
                pagination: {
                    el: ".swiperThumbnails .swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiperThumbnails .swiper-button-next",
                    prevEl: ".swiperThumbnails .swiper-button-prev",
                },
                slideToClickedSlide: true,
            });

            swiperCabecera = new Swiper(".swiperCabecera", {
                slidesPerView: 1,
                loop: true,
                navigation: {
                    nextEl: ".swiperCabecera .swiper-button-next",
                    prevEl: ".swiperCabecera .swiper-button-prev",
                },
                thumbs: {
                    swiper: swiperThumbnails
                }
            });

            function updateActiveThumbnail() {
                swiperThumbnails.slides.forEach(function(slide) {
                    slide.classList.remove('swiper-slide-thumb-active');
                });
                var activeIndex = swiperCabecera.activeIndex;
                swiperThumbnails.slides[activeIndex].classList.add('swiper-slide-thumb-active');
            }

            swiperCabecera.on('slideChange', updateActiveThumbnail);
            swiperThumbnails.on('click', function(swiper) {
                swiperCabecera.slideTo(swiper.clickedIndex);
            });
            swiperThumbnails.on('slideChange', function() {
                var activeIndex = swiperThumbnails.activeIndex;
                swiperCabecera.slideTo(activeIndex);
            });
        }

        function updateSwipersOnResize() {
            if (window.innerWidth > 1000 && swiperThumbnails.params.direction !== 'vertical') {
                swiperThumbnails.changeDirection('vertical');
                swiperThumbnails.params.slidesPerView = 5;
                swiperThumbnails.update();
            } else if (window.innerWidth <= 1000 && window.innerWidth > 700 && swiperThumbnails.params.direction !==
                'horizontal') {
                swiperThumbnails.changeDirection('horizontal');
                swiperThumbnails.params.slidesPerView = 6;
                swiperThumbnails.update();
            } else if (window.innerWidth <= 700 && window.innerWidth > 500 && swiperThumbnails.params.slidesPerView !== 4) {
                swiperThumbnails.changeDirection('horizontal');
                swiperThumbnails.params.slidesPerView = 4;
                swiperThumbnails.update();
            } else if (window.innerWidth <= 500 && swiperThumbnails.params.slidesPerView !== 4) {
                swiperThumbnails.changeDirection('horizontal');
                swiperThumbnails.params.slidesPerView = 4;
                swiperThumbnails.update();
            }
        }

        // Inicializa los Swipers al cargar la página
        initializeSwipers();

        // Ajusta la configuración de Swipers cuando la ventana cambia de tamaño
        window.addEventListener('resize', function() {
            updateSwipersOnResize();
        });
    </script>
@endif
