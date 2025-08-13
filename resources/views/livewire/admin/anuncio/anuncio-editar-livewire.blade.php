@section('tituloPagina', 'Editar anuncio')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Editar anuncio</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.anuncio.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.anuncio.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
    <!--FORMULARIO-->
    <div class="formulario">

        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--NOMBRE-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--IMAGEN COMPUTADORA-->
                    <div class="g_margin_bottom_20">
                        <label for="url_imagen">Imagen <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="url_imagen" name="url_imagen" wire:model.live="url_imagen" required>
                        @error('url_imagen')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LINK-->
                    <div class="g_margin_bottom_20">
                        <label for="link">Link</label>
                        <input type="text" id="link" name="link" wire:model.live="link" required>
                        @error('link')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA INICIO-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_inicio">Fecha inicio <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio"
                            wire:model.live="fecha_inicio" required>
                        @error('fecha_inicio')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA FIN-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_fin">Fecha fin <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" wire:model.live="fecha_fin"
                            required>
                        @error('fecha_fin')
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
                        <p class="leyenda">Elija uno de ellos</p>
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
                        <p class="leyenda">Elija uno de ellos</p>
                        @error('alianza_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--CANDIDATO-->
                    <div class="g_margin_bottom_20">
                        <label for="candidato_id">Candidato</label>
                        <select id="candidato_id" name="candidato_id" wire:model.live="candidato_id">
                            <option value="">Seleccionar un candidato</option>
                            @foreach ($candidatos as $candidato)
                                <option value="{{ $candidato->id }}">{{ $candidato->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="leyenda">Elija uno de ellos</p>
                        @error('candidato_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    @error('relacionados')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--AUSPICIADOR-->
                    <div class="g_margin_bottom_20">
                        <label for="auspiciador_id">Auspiciador</label>
                        <select id="auspiciador_id" name="auspiciador_id" wire:model.live="auspiciador_id">
                            <option value="">Seleccionar una auspiciador</option>
                            @foreach ($auspiciadores as $auspiciador)
                                <option value="{{ $auspiciador->id }}">{{ $auspiciador->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="leyenda">Elija uno de ellos</p>
                        @error('auspiciador_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>


                    <!--PAGINA-->
                    <div class="g_margin_bottom_20">
                        <label for="pagina">Página</label>
                        <select id="pagina" name="pagina" wire:model.live="pagina">
                            <option value="">Seleccionar una pagina</option>
                            <option value="encuesta">Encuesta</option>
                            <option value="resultado">Resultado</option>
                        </select>
                        <p class="leyenda">Elija uno de ellos</p>
                        @error('pagina')
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
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="editarAnuncio" class="guardar" wire:loading.attr="disabled">Guardar</button>

                <a href="{{ route('admin.anuncio.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
