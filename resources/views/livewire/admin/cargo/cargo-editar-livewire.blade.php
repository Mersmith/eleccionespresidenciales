@section('tituloPagina', 'Editar cargo')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Editar cargo</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.cargo.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>
            <a href="{{ route('admin.cargo.vista.todas') }}" class="g_boton g_boton_darkt">
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
                        <label for="nombre">Nombre <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NIVEL-->
                    <div class="g_margin_bottom_20">
                        <label for="nivel">Nivel <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="nivel" name="nivel" wire:model.live="nivel" required>
                            <option value="nacional">NACIONAL</option>
                            <option value="regional">REGIONAL</option>
                            <option value="provincial">PROVINCIAL</option>
                            <option value="distrital">DISTRITAL</option>
                        </select>
                        @error('nivel')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ELECCIONES-->
                    <div class="g_margin_bottom_20">
                        <label for="eleccion_id">Tipo elección <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="eleccion_id" name="eleccion_id" wire:model.live="eleccion_id" required>
                            <option value="" selected disabled>Seleccionar una elección</option>
                            @if ($elecciones)
                            @foreach ($elecciones as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('eleccion_id')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!-- Puedes agregar info adicional aquí -->
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="actualizarCargo" class="guardar">Actualizar</button>
                <a href="{{ route('admin.cargo.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
