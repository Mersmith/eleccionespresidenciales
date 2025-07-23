@section('tituloPagina', 'Crear elección')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear elección</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--AÑO DE VOTACIÓN-->
                    <div class="g_margin_bottom_20">
                        <label for="anio">Año de votación <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="anio" name="anio" wire:model.live="anio" required>
                            <option value="">Seleccione año</option>
                            @for($i = now()->year; $i <= now()->year + 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                        </select>
                        @error('anio')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--TIPO-->
                    <div class="g_margin_bottom_20">
                        <label for="tipo">Tipo de elección <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="tipo" name="tipo" wire:model.live="tipo" required>
                            <option value="generales">GENERALES</option>
                            <option value="regionales_y_municipales">REGIONALES Y MUNICIPALES</option>
                        </select>
                        </select>
                        @error('tipo')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required disabled>
                        <p class="leyenda">Se genera automático</p>
                        @error('nombre')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--SLUG-->
                    <div class="g_margin_bottom_20">
                        <label for="slug">Slug <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="slug" name="slug" wire:model.live="slug" required disabled>
                        <p class="leyenda">Se genera automático</p>
                        @error('slug')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- FECHA DE VOTACIÓN -->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_votacion">
                            Fecha de votación <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span>
                        </label>
                        <input type="date" id="fecha_votacion" name="fecha_votacion" wire:model.live="fecha_votacion" min="{{ $anio ? $anio . '-01-01' : '' }}" max="{{ $anio ? $anio . '-12-31' : '' }}" @if (!$anio) disabled @endif required>
                        <p class="leyenda">Solo eliga el mes y el dia de la votación.</p>
                        @error('fecha_votacion')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--IMAGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="imagen_ruta">Imagen</label>
                        <input type="text" id="imagen_ruta" name="imagen_ruta" wire:model.live="imagen_ruta">
                        <p class="leyenda">El logo de la elección</p>
                        @error('imagen_ruta')
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
                <button wire:click="crearEleccion" class="guardar">Guardar</button>

                <a href="{{ route('admin.eleccion.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
