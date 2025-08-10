@section('tituloPagina', 'Editar cargo')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Editar cargo de: {{ $candidato->nombre }}</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.editar', $candidatoId) }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.vista.editar', $candidatoId) }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--NIVELES-->
                    <div class="g_margin_bottom_20">
                        <label for="nivel_id">Nivel <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="nivel_id" name="nivel_id" wire:model.live="nivel_id" required>
                            <option value="" selected disabled>Seleccionar un nivel</option>
                            @if ($niveles)
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('nivel_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--CARGOS-->
                    <div class="g_margin_bottom_20">
                        <label for="cargo_id">Cargo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="cargo_id" name="cargo_id" wire:model.live="cargo_id" required>
                            <option value="" selected disabled>Seleccionar un cargo</option>
                            @if ($cargos)
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('cargo_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ELECCIONES-->
                    <div class="g_margin_bottom_20">
                        <label for="eleccion_id">Elección <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="eleccion_id" name="eleccion_id" wire:model.live="eleccion_id" required>
                            <option value="" selected disabled>Seleccionar una elección</option>
                            @if ($elecciones)
                                @foreach ($elecciones as $eleccion)
                                    <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('eleccion_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PARTIDO-->
                    <div class="g_margin_bottom_20">
                        <label for="partido_id">Partido</label>
                        <select id="partido_id" name="partido_id" wire:model.live="partido_id">
                            <option value="" selected>Seleccionar un partido</option>
                            @if ($partidos)
                                @foreach ($partidos as $partido)
                                    <option value="{{ $partido->id }}">{{ $partido->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        <p class="leyenda">Elija partido o alianza.</p>
                        @error('partido_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ALIANZA-->
                    <div class="g_margin_bottom_20">
                        <label for="alianza_id">Alianza</label>
                        <select id="alianza_id" name="alianza_id" wire:model.live="alianza_id">
                            <option value="">Seleccionar una alianza</option>
                            @foreach ($alianzas as $alianza)
                                <option value="{{ $alianza->id }}">{{ $alianza->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="leyenda">Elija alianza o partido.</p>
                        @error('alianza_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div>
                        <label for="numero">Número de candidato</label>
                        <input type="text" id="numero" name="numero" wire:model.live="numero" required>
                        <p class="leyenda">Si el cargo es para número es obligatorio</p>
                        @error('numero')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Activo</h4>

                    <!--ACTIVO-->
                    <select id="activo" name="activo" wire:model="activo">
                        <option value="0" selected>DESACTIVADO</option>
                        <option value="1">ACTIVO</option>
                    </select>
                    @error('activo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Principal</h4>

                    <!--PRINCIPAL-->
                    <select id="principal" name="principal" wire:model="principal">
                        <option value="0" selected>NO</option>
                        <option value="1">SI</option>
                    </select>
                    @error('principal')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Electo</h4>

                    <!--ELECTO-->
                    <select id="electo" name="electo" wire:model="electo">
                        <option value="0" selected>NO</option>
                        <option value="1">SI</option>
                    </select>
                    @error('electo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Alcance</h4>

                    <!--PAIS-->
                    <div class="g_margin_bottom_20">
                        <label for="pais_id">Pais <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="pais_id" name="pais_id" wire:model.live="pais_id" required>
                            <option value="" selected disabled>Seleccionar un pais</option>
                            @if ($paises)
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('pais_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--REGION-->
                    <div class="g_margin_bottom_20">
                        <label for="region_id">Región <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="region_id" name="region_id" wire:model.live="region_id" required>
                            <option value="" selected disabled>Seleccionar una región</option>
                            @if ($regiones)
                                @foreach ($regiones as $region)
                                    <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('region_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PROVINCIA-->
                    <div class="g_margin_bottom_20">
                        <label for="provincia_id">Provincia <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="provincia_id" name="provincia_id" wire:model.live="provincia_id" required>
                            <option value="" selected disabled>Seleccionar una pronvincia</option>
                            @if ($provincias)
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('provincia_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DISTRITO-->
                    <div>
                        <label for="distrito_id">Distrito <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="distrito_id" name="distrito_id" wire:model.live="distrito_id" required>
                            <option value="">Seleccionar un distrito</option>
                            @if ($distritos)
                                @foreach ($distritos as $distrito)
                                    <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('distrito_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="actualizarCandidatoCargo" class="guardar">Actualizar</button>

                <a href="{{ route('admin.candidato.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>

</div>
