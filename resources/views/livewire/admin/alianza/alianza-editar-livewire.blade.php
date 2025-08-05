@section('tituloPagina', 'Editar alianza')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Editar alianza</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.alianza.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="#" class="g_boton g_boton_primary">
                Social <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('admin.alianza.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
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

                    <!--SLUG-->
                    <div class="g_margin_bottom_20">
                        <label for="slug">Slug <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="slug" name="slug" wire:model.live="slug" required disabled>
                        <p class="leyenda">Se genera automático</p>
                        @error('slug')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--SIGLAS-->
                    <div class="g_margin_bottom_20">
                        <label for="sigla">Sigla</label>
                        <input type="text" id="sigla" name="sigla" wire:model.live="sigla" required>
                        @error('sigla')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LOGO-->
                    <div class="g_margin_bottom_20">
                        <label for="logo">Logo</label>
                        <input type="text" id="logo" name="logo" wire:model.live="logo" required>
                        @error('logo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PLAN GOBIERNO-->
                    <div class="g_margin_bottom_20">
                        <label for="plan_gobierno">Plan de gobierno</label>
                        <input type="text" id="plan_gobierno" name="plan_gobierno" wire:model.live="plan_gobierno"
                            required>
                        @error('plan_gobierno')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ELECCIÓN-->
                    <div>
                        <label for="eleccion_id">Elección <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="eleccion_id" name="eleccion_id" wire:model.live="eleccion_id" required>
                            <option value="">Seleccionar una elección</option>
                            @foreach ($elecciones as $eleccion)
                                <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                            @endforeach
                        </select>
                        @error('eleccion_id')
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
                    <h4 class="g_panel_titulo">Redes</h4>

                    @if (!empty($redes_sociales))
                        <div>
                            @foreach ($redes_sociales as $elemento)
                                @if (!empty($elemento['url']))
                                    <a href="{{ $elemento['url'] }}" target="_blank"
                                        style="color: {{ $elemento['color'] }}">
                                        {!! $elemento['icono'] !!}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Partidos</h4>

                    <div>
                        @foreach ($partidos as $partido)
                            <div>
                                <input type="checkbox" wire:model.live="partidosSeleccionados"
                                    value="{{ $partido->id }}">
                                <span>{{ $partido->nombre }}</span>
                            </div>
                        @endforeach
                        @error('partidosSeleccionados')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="actualizarAlianza" class="guardar">Guardar</button>

                <a href="{{ route('admin.alianza.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
