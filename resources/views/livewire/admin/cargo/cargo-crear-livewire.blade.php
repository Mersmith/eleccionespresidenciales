@section('tituloPagina', 'Cargo')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear cargo</h2>

        <!--BOTONES-->
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
                    <!--CARGO-->
                    <div class="g_margin_bottom_20">
                        <label for="nivel">Región <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="nivel" name="nivel" wire:model.live="nivel" required>
                            <option value="nacional">NACIONAL</option>
                            <option value="regional">REGIONAL</option>
                            <option value="provincial">PROVINCIAL</option>
                            <option value="distrital">DISTRITAL</option>
                        </select>
                        </select>
                        @error('nivel')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">

                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="crearCargo" class="guardar">Guardar</button>

                <a href="{{ route('admin.cargo.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
