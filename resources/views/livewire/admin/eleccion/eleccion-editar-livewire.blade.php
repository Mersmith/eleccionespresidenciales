@section('tituloPagina', 'Elección')
<div>
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <!-- TITULO -->
        <h2>Editar elección</h2>

        <!-- BOTONES -->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>

            <a href="{{ route('admin.eleccion.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <!-- FORMULARIO -->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!-- AÑO -->
                    <div class="g_margin_bottom_20">
                        <label for="anio">Año <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="anio" name="anio" wire:model.live="anio" required>
                            <option value="">Seleccione año</option>
                            @for ($i = now()->year; $i <= now()->year + 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('anio')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TIPO -->
                    <div class="g_margin_bottom_20">
                        <label for="tipo">Tipo <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <select id="tipo" name="tipo" wire:model.live="tipo" required>
                            <option value="generales">GENERALES</option>
                            <option value="regionales_y_municipales">REGIONALES Y MUNICIPALES</option>
                        </select>
                        @error('tipo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NOMBRE -->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- FECHA DE VOTACIÓN -->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_votacion">Fecha de votación <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input
                            type="date"
                            id="fecha_votacion"
                            name="fecha_votacion"
                            wire:model.live="fecha_votacion"
                            min="{{ $anio ? $anio . '-01-01' : '' }}"
                            max="{{ $anio ? $anio . '-12-31' : '' }}"
                            @if (!$anio) disabled @endif
                            required
                        >
                        @error('fecha_votacion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!-- Espacio adicional para widgets o datos relacionados -->
                </div>
            </div>
        </div>

        <!-- BOTONES -->
        <div class="formulario_botones">
            <button wire:click="actualizarEleccion" class="guardar">Actualizar</button>
            <a href="{{ route('admin.eleccion.vista.todas') }}" class="cancelar">Cancelar</a>
        </div>
    </div>
</div>
