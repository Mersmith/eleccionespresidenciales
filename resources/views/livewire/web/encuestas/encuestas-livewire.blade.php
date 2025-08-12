@section('tituloPagina', 'VotaXmi - Sistema web de encuestas y elecciones en Perú')

@section('descripcion', 'VotaXmi es un sistema web especializado en encuestas y procesos electorales para elecciones presidenciales, municipales y regionales en Perú. Participa y vota fácilmente.')

@section('meta_image', asset('assets/images/imagen-defecto.jpg'))

<div class="g_contenedor_pagina">
    <div class="g_centrar_pagina">

        <div class="g_pading_pagina g_gap_pagina">

            <div class="g_grid_pagina_filtro">
                <!-- COLUMNA 1 -->
                <div class="g_grid_columna_1">
                    <div class="contenedor_filtros g_card_panel g_card_flex_column">

                        <h4 class="g_texto_nivel_6">Filtros</h4>

                        <div>
                            <label for="tipoEleccionSeleccionada" class="g_texto_nivel_4">Tipo elección:</label>
                            <select wire:model.live="tipoEleccionSeleccionada" id="tipoEleccionSeleccionada"
                                name="tipoEleccionSeleccionada">
                                <option value="" disabled>Selecciona tipo de elección</option>
                                @foreach ($tipos_elecciones as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($tipoEleccionSeleccionada)
                            <div>
                                <label for="eleccionSeleccionada" class="g_texto_nivel_4">Elección:</label>
                                <select wire:model.live="eleccionSeleccionada" id="eleccionSeleccionada"
                                    name="eleccionSeleccionada">
                                    <option value="" disabled>Selecciona elección</option>
                                    @foreach ($elecciones as $eleccion)
                                        <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($eleccionSeleccionada)
                            <div>
                                <label for="cargoSeleccionada" class="g_texto_nivel_4">Cargo:</label>
                                <select wire:model.live="cargoSeleccionada" id="cargoSeleccionada"
                                    name="cargoSeleccionada">
                                    <option value="" disabled>Selecciona cargo</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($cargoSeleccionada)
                            <div>
                                <label for="regionSeleccionada" class="g_texto_nivel_4">Región:</label>
                                <select wire:model.live="regionSeleccionada" id="regionSeleccionada"
                                    name="regionSeleccionada">
                                    <option value="" disabled>Selecciona region</option>
                                    @foreach ($regiones as $region)
                                        <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($regionSeleccionada)
                            <div>
                                <label for="provinciaSeleccionada" class="g_texto_nivel_4">Provincia:</label>
                                <select wire:model.live="provinciaSeleccionada" id="provinciaSeleccionada"
                                    name="provinciaSeleccionada">
                                    <option value="" disabled>Selecciona provincia</option>
                                    @foreach ($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($provinciaSeleccionada)
                            <div>
                                <label for="distritoSeleccionada" class="g_texto_nivel_4">Distrito:</label>
                                <select wire:model.live="distritoSeleccionada" id="distritoSeleccionada"
                                    name="distritoSeleccionada">
                                    <option value="" disabled>Selecciona distrito</option>
                                    @foreach ($distritos as $distrito)
                                        <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <button wire:click="limpiarFiltros" type="button" class="boton_siguiente">
                            Limpiar filtros
                        </button>
                    </div>
                </div>

                <!-- COLUMNA 2 -->
                <div class="g_grid_columna_2">
                    @if ($encuestas->count())
                        <div class="g_card_panel g_card_partial_column">
                            <h2 class="g_texto_nivel_6 g_texto_borde_izquierdo g_texto_subrayado">Encuestas
                            </h2>

                            @include('web.partials.lista-encuesta', [
                                'p_elemento' => $encuestas,
                            ])

                            {{ $encuestas->links() }}
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>
</div>
