@section('tituloPagina', 'Crear plan')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear plan</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.plan.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.plan.vista.todas') }}" class="g_boton g_boton_darkt">
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
             
                    <!--SIGLAS-->
                    <div class="g_margin_bottom_20">
                        <label for="precio">Precio <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="precio" name="precio" wire:model.live="precio" required>
                        @error('precio')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        @error('descripcion')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>                 
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">¿Requiere pago?</h4>

                    <!--ACTIVO-->
                    <select id="requiere_pago" name="requiere_pago" wire:model="requiere_pago">
                        <option value="0" selected>SI</option>
                        <option value="1">NO</option>
                    </select>
                    @error('requiere_pago')
                    <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="crearPlan" class="guardar">Guardar</button>

                <a href="{{ route('admin.plan.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
