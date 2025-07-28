@if (!empty($p_elemento) && $p_elemento['productos']->isNotEmpty())
    <div>
        @include('ecommerce.partials.titulo', [
            'p_contenido' => $p_elemento['slider']['titulo'],
            'p_alineacion' => 'left',
            'p_color' => '#000000',
        ])

        <div class="partials_contenedor_slider_productos">
            <!-- Swiper -->
            <div class="swiper SwiperSliderProducto-{{ $p_elemento['id'] }}">
                <div class="swiper-wrapper">
                    @foreach ($p_elemento['productos'] as $index => $producto)
                        <div class="swiper-slide">
                            <div>
                                <a href="{{ url('product/' . $producto->producto_id . '/' . $producto->producto_url) }}">
                                    <div class="contenedor_imagen">
                                        @if ($producto->imagen_url)
                                            <img src="{{ $producto->imagen_url }}"
                                                alt="{{ $producto->imagen_descripcion }}">
                                        @else
                                            <img src="{{ asset('assets/imagenes/producto/producto-tipo-1-1.jpg') }}"
                                                alt="">
                                        @endif

                                        @if ($producto->porcentaje_descuento)
                                            <span>{{ $producto->porcentaje_descuento }}%</span>
                                        @endif
                                    </div>
                                </a>
                                <div class="marca">{{ $producto->marca_nombre }}</div>
                                <div class="titulo">{{ $producto->producto_id . '' . $producto->producto_nombre }}</div>

                                @if ($producto->precio_oferta)
                                    <div class="precio_oferta">
                                        <span>S/.</span>
                                        <span>{{ $producto->precio_oferta }}</span>
                                    </div>
                                @endif
                                @if ($producto->precio_normal)
                                    <div class="precio_real">
                                        <span>S/.</span>
                                        <span>{{ $producto->precio_normal }}</span>
                                    </div>
                                @endif
                                @if ($producto->precio_antiguo)
                                    <div class="precio_antiguo">
                                        <span>S/.</span>
                                        <span>{{ $producto->precio_antiguo }}</span>
                                    </div>
                                @endif
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
