@if (!empty($p_elemento) && !empty($p_elemento->enlaces))
    <div x-data="dataEnlacesRapidos{{ $p_elemento->id }}()">
        <div class="contendor_enlaces_rapidos">
            <div class="g_centrar_pagina">
                <div>
                    @if ($p_elemento->nombre)
                        @include('ecommerce.partials.titulo', [
                            'p_contenido' => $p_elemento->nombre,
                            'p_alineacion' => 'center',
                            'p_color' => '#4a4a4a',
                        ])
                    @endif

                    <!-- CONTENEDOR ENLACES -->
                    <div class="grid_mostrador" :class="{ 'mostrar_todos': mostrarTodos }">
                        @foreach ($p_elemento->enlaces as $index => $categoria)
                            <div class="item">
                                <p>{{ $categoria['titulo'] }}</p>
                                <ul>
                                    @foreach ($categoria['elementos'] as $elemento)
                                        <li><a href="{{ $elemento['link'] }}">{{ $elemento['nombre'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <!-- CONTENEDOR CONTROL -->
                    <div class="contenedor_control_mostrar">
                        <p x-show="!mostrarTodos" @click="mostrarTodos = true">
                            Mostrar más <span class="invertido">^</span>
                        </p>
                        <p x-show="mostrarTodos" style="display: none;" @click="mostrarTodos = false">
                            Mostrar menos <span class="normal">^</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dataEnlacesRapidos{{ $p_elemento->id }}() {
            return {
                mostrarTodos: false
            }
        }
    </script>
@endif
