@section('tituloPagina', 'Red Social')

@section('anchoPantalla', '100%')

<div x-data="dataSocialPartido">

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Red social de: {{ $partido->nombre }}</h2>

        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.partido.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>

            <a href="{{ route('admin.partido.vista.editar', $partido->id) }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <div class="formulario">

        <div class="g_fila" x-data="{ globalVisible: true, itemsVisibility: Array({{ count($contenido) }}).fill(true) }">
            <div class="g_columna_12">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">
                        Items
                        <!-- Botón General para Mostrar/Ocultar Todos -->
                        <button type="button"
                            @click="globalVisible = !globalVisible; itemsVisibility = itemsVisibility.map(() => globalVisible)">
                            <span x-show="globalVisible"><i class="fa-solid fa-angle-up"></i></span>
                            <span x-show="!globalVisible"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                    </h4>

                    <div x-sort="handlePartidoSocial">
                        @foreach ($contenido as $index => $item)
                            <div x-sort:item="{{ $item['id'] }}" class="g_panel tabla_caja">
                                <div class="cabecera">
                                    <span><i class="fa-solid fa-up-down-left-right"></i></span>
                                    <!-- Botón Individual para Mostrar/Ocultar -->
                                    <button type="button"
                                        @click="itemsVisibility[{{ $index }}] = !itemsVisibility[{{ $index }}]">
                                        <span x-show="itemsVisibility[{{ $index }}]"><i
                                                class="fa-solid fa-angle-up"></i></span>
                                        <span x-show="!itemsVisibility[{{ $index }}]"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                    </button>
                                </div>

                                <h4 class="g_panel_titulo">ID: {{ $contenido[$index]['id'] }}</h4>

                                <!-- Contenido para Mostrar/Ocultar -->
                                <div x-show="itemsVisibility[{{ $index }}]" x-transition>

                                    <div class="g_fila">
                                        <div class="g_columna_6">

                                            <!-- ICONO -->
                                            <div class="g_margin_bottom_20">
                                                <label for="contenido_icono_{{ $index }}">Icono <span
                                                        class="obligatorio"><i
                                                            class="fa-solid fa-asterisk"></i></span></label>
                                                <input disabled type="text" id="contenido_icono_{{ $index }}"
                                                    name="contenido_icono_{{ $index }}"
                                                    wire:model="contenido.{{ $index }}.icono"
                                                    placeholder="<i class='fa-brands fa-facebook'></i>">
                                                <p class="leyenda"><a
                                                        href="https://fontawesome.com/v6/search?o=r&m=free"
                                                        target="_blank"><i class="fa-solid fa-link"></i> Biblioteca de
                                                        iconos</a> </p>
                                                @error("contenido.{$index}.icono")
                                                    <p class="mensaje_error">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- COLOR -->
                                            <div class="g_margin_bottom_20">
                                                <label for="contenido_color_{{ $index }}">Color <span
                                                        class="obligatorio"><i
                                                            class="fa-solid fa-asterisk"></i></span></label>
                                                <input disabled type="color" id="contenido_color_{{ $index }}"
                                                    name="contenido_color_{{ $index }}"
                                                    wire:model="contenido.{{ $index }}.color">
                                                @error("contenido.{$index}.color")
                                                    <p class="mensaje_error">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- URL -->
                                            <div>
                                                <label for="contenido_url_{{ $index }}">Link social <span
                                                        class="obligatorio"><i
                                                            class="fa-solid fa-asterisk"></i></span></label>
                                                <input type="text" id="contenido_url_{{ $index }}"
                                                    name="contenido_url_{{ $index }}"
                                                    wire:model="contenido.{{ $index }}.url">
                                                @error("contenido.{$index}.url")
                                                    <p class="mensaje_error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="guardarPartidoSocial" class="guardar">Guardar</button>
            </div>
        </div>
    </div>

    <script>
        function dataSocialPartido() {
            return {
                handlePartidoSocial(item, position) {
                    //console.log(item, position);

                    Livewire.dispatch('handlePartidoSocialOn', {
                        item: item,
                        position: position,
                    });
                },
            }
        }
    </script>
</div>
