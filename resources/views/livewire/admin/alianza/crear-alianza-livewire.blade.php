@section('tituloPagina', 'Crear alianza')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear alianza</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.alianza.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

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
                        <label for="sigla">Sigla <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="sigla" name="sigla" wire:model.live="sigla" required>
                        @error('sigla')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LOGO-->
                    <div class="g_margin_bottom_20">
                        <label for="logo">Logo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="logo" name="logo" wire:model.live="logo" required>
                        @error('logo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label>Elección:</label>
                        <select wire:model.live="eleccion_id" class="w-full border p-2">
                            <option value="">-- Seleccione --</option>
                            @foreach ($elecciones as $eleccion)
                                <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                            @endforeach
                        </select>
                        @error('eleccion_id')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Partidos:</label>
                        @foreach ($partidos as $partido)
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" wire:model.live="partidosSeleccionados"
                                    value="{{ $partido->id }}">
                                <span>{{ $partido->nombre }}</span>
                            </div>
                        @endforeach
                        @error('partidosSeleccionados')
                            <span class="text-red-600">{{ $message }}</span>
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
                <button wire:click="crearAlianza" class="guardar">Guardar</button>

                <a href="{{ route('admin.alianza.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
