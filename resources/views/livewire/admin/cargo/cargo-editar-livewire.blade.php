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
                    
                    <!--ELECCIONES-->
                    <div class="g_margin_bottom_20">
                        <label for="tipo_eleccion_id">Tipo elección <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="tipo_eleccion_id" name="tipo_eleccion_id" wire:model.live="tipo_eleccion_id" required>
                            <option value="" selected disabled>Seleccionar una elección</option>
                            @if ($tipo_elecciones)
                            @foreach ($tipo_elecciones as $eleccion)
                            <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('tipo_eleccion_id')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NIVELES-->
                    <div class="g_margin_bottom_20">
                        <label for="nivel_id">Nivel <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
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
