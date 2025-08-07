@section('tituloPagina', 'Crear auspiciador')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear auspiciador</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.auspiciador.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.auspiciador.vista.todas') }}" class="g_boton g_boton_darkt">
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

                    <!--EMPRESA-->
                    <div class="g_margin_bottom_20">
                        <label for="empresa">Empresa</label>
                        <input type="text" id="empresa" name="empresa" wire:model.live="empresa" required>
                        @error('empresa')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--CELULAR-->
                    <div class="g_margin_bottom_20">
                        <label for="celular">Celular</label>
                        <input type="text" id="celular" name="celular" wire:model.live="celular" required>
                        @error('celular')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--OBSERVACIÓN-->
                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observacion</label>
                        <textarea id="observacion" wire:model.live="observacion" rows="3"></textarea>
                        @error('observacion')
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
                    <h4 class="g_panel_titulo">Plan</h4>

                    <!--PLAN-->
                    <div>
                        <select id="plan_id" name="plan_id" wire:model.live="plan_id" required>
                            <option value="">Seleccionar un plan</option>
                            @if ($planes)
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('plan_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="crearAuspiciador" class="guardar">Guardar</button>

                <a href="{{ route('admin.auspiciador.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
