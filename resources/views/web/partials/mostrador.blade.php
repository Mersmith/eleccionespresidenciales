@if (!empty($p_elemento) && $p_elemento['partidos']->isNotEmpty())
    <div>
            @include('web.partials.titulo', [
                'p_contenido' => $p_elemento['titulo'],
                'p_alineacion' => 'center',
                'p_color' => '#4a4a4a',
            ])

        <div x-data="dataMostrador{{ $p_elemento['id'] }}()" class="partials_contenedor_mostrador">
            <!-- CONTENEDOR GRID -->
            <div class="grid_mostrador" :class="{ 'mostrar_todos': mostrarTodos }">
                @foreach ($p_elemento['partidos'] as $index => $item)
                    <div class="item">
                        <a href="#">
                            <!-- IMAGENES -->
                            <img src="{{ $item->logo }}" alt="" />
                             <p>{{ $item->nombre }}</p>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- CONTENEDOR CONTROL -->
            @if (count($p_elemento['partidos']) > 6)
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
            function dataMostrador{{ $p_elemento['id'] }}() {
                return {
                    mostrarTodos: false
                }
            }
        </script>
    </div>
@endif
