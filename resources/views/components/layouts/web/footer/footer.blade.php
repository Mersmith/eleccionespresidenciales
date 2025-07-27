@if ($p_elementos)

    @if (!empty($p_elementos->enlaces_rapidos))
        <div x-data="dataEcommerceFooter">
            <div class="contenedor_enlaces_rapidos">
                <div class="g_centrar_pagina">
                    <div class="">
                        <div class="">
                            <div class="grid_contenedor_items">
                                @foreach ($p_elementos->enlaces_rapidos as $index => $data)
                                    <div class="contenedor_item">
                                        <!-- CONTENEDOR TITULO -->
                                        <div @click="toggleAccordion({{ $index }})" class="contenedor_titulo">
                                            <p>{{ $data['titulo'] }}</p>

                                            <!-- CONTENEDOR CONTROL -->
                                            <span class="contenedor_control"
                                                x-text="itemIndex === {{ $index }} ? '-' : '+'"></span>
                                        </div>

                                        <!-- CONTENEDOR ACORDEON -->
                                        <ul class="contenedor_acordeon"
                                            :class="{ 'mostrar': itemIndex === {{ $index }} }">
                                            @foreach ($data['elementos'] as $elemento)
                                                <li>
                                                    <a href="{{ $elemento['link'] }}">{{ $elemento['nombre'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function dataEcommerceFooter() {
                return {
                    itemIndex: null,
                    toggleAccordion(index) {
                        if (this.itemIndex === index) {
                            this.itemIndex = null;
                        } else {
                            this.itemIndex = index;
                        }
                    }
                }
            }
        </script>
    @endif

    <div class="footer">
        <div class="g_centrar_pagina">
            <div class="">
                <div class="">
                    <!-- CONTENEDOR REDES - TERMINOS -->
                    <div class="contenedor_redes_terminos">

                        @if (!empty($p_elementos->redes_sociales))
                            <!-- CONTENEDOR REDES -->
                            <div class="contenedor_redes">
                                @foreach ($p_elementos->redes_sociales as $item)
                                    <a href="{{ $item['link'] }}" target="_blank">{!! $item['icono'] !!}</a>
                                @endforeach
                            </div>
                        @endif

                        @if (!empty($p_elementos->terminos))
                            <!-- CONTENEDOR TERMINOS -->
                            <div class="contenedor_terminos">
                                @foreach ($p_elementos->terminos as $item)
                                    <a href="{{ $item['link'] }}" target="_blank">{{ $item['nombre'] }}</a>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    <!-- CONTENEDOR DERECHOS -->
                    <div class="contenedor_derechos">
                        <p>{{ $p_elementos->derechos }}</p>
                        <span>{{ $p_elementos->direccion }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
