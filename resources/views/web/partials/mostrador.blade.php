@if (!empty($p_elemento) && !empty($p_elemento->imagenes))
    <div>
        @if ($p_elemento->nombre)
            @include('ecommerce.partials.titulo', [
                'p_contenido' => $p_elemento->nombre,
                'p_alineacion' => 'center',
                'p_color' => '#4a4a4a',
            ])
        @endif

        <div x-data="dataMostrador{{ $p_elemento->id }}()" class="partials_contenedor_mostrador">
            <!-- CONTENEDOR GRID -->
            <div class="grid_mostrador" :class="{ 'mostrar_todos': mostrarTodos }">
                @foreach ($p_elemento->imagenes as $index => $item)
                    <div class="item">
                        <a href="{{ $item['link'] }}">
                            <!-- IMAGENES -->
                            <img src="{{ $item['imagen'] }}" alt="{{ $item['titulo'] }}" />
                            @if ($item['titulo'])
                                <p>{{ $item['titulo'] }}</p>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- CONTENEDOR CONTROL -->
            @if (count($p_elemento->imagenes) > 6)
                <div class="contenedor_control_mostrar">
                    <p x-show="!mostrarTodos" @click="mostrarTodos = true">
                        Mostrar más <span class="invertido">^</span>
                    </p>
                    <p x-show="mostrarTodos" style="display: none;" @click="mostrarTodos = false">
                        Mostrar menos <span class="normal">^</span>
                    </p>
                </div>
            @endif
        </div>

        <script>
            function dataMostrador{{ $p_elemento->id }}() {
                return {
                    mostrarTodos: false
                }
            }
        </script>
    </div>
@endif
