@section('tituloPagina', 'Editar partido')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Editar partido</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.partido.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>
            <a href="{{ route('admin.partido.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
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
                        <input type="text" id="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--SIGLA-->
                    <div class="g_margin_bottom_20">
                        <label for="sigla">Sigla <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="sigla" wire:model.live="sigla" required>
                        @error('sigla')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LOGO-->
                    <div class="g_margin_bottom_20">
                        <label for="logo">Logo <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="logo" wire:model.live="logo" required>
                        @error('logo')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!-- Espacio para vista previa de logo u otra info -->
                </div>
            </div>
        </div>

        <div class="formulario_botones">
            <button wire:click="actualizarPartido" class="guardar">Actualizar</button>
            <a href="{{ route('admin.partido.vista.todas') }}" class="cancelar">Cancelar</a>
        </div>
    </div>
</div>
