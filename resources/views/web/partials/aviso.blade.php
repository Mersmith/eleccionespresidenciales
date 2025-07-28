@if (!empty($p_elemento)&& $p_elemento['candidatos']->isNotEmpty())

<div>
    @include('web.partials.titulo', [
            'p_contenido' => $p_elemento['titulo'],
            'p_alineacion' => 'left',
            'p_color' => '#000000',
        ])

    <div class="partials_contenedor_aviso">
        <!-- Swiper -->
        <div class="swiper SwiperAviso-{{$p_elemento['id']}}">
            <div class="swiper-wrapper">
                @foreach ($p_elemento['candidatos'] as $postulacion)
                <div class="swiper-slide">
                    <a href="#}">
                        <img src="{{ $postulacion->candidato->foto}}" alt="" />
                        <p>{{ $postulacion->candidato->nombre }}</p>
                        <p>{{ $postulacion->candidato->partido->nombre }}</p>
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
        var swiper = new Swiper('.SwiperAviso-{{ $p_elemento['id'] }}', {
            slidesPerView: 4
            , spaceBetween: 0
            , navigation: {
                nextEl: '.SwiperAviso-{{ $p_elemento['id'] }} .swiper-button-next'
                , prevEl: '.SwiperAviso-{{ $p_elemento['id'] }} .swiper-button-prev'
            , }
            , pagination: {
                el: '.SwiperAviso-{{ $p_elemento['id'] }} .swiper-pagination'
                , clickable: true
            , }
            , breakpoints: {
                1024: {
                    slidesPerView: 5
                , }
                , 700: {
                    slidesPerView: 3
                , }
                , 0: {
                    slidesPerView: 2
                , }
            }
        });
    
    </script>
</div>
@endif
