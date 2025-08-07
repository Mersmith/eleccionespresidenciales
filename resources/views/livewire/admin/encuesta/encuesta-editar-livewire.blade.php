@section('tituloPagina', 'Editar Encuesta')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Editar encuesta</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.encuesta.candidato.editar', $encuesta->id) }}" class="g_boton g_boton_primary">
                Particantes <i class="fa-solid fa-user-tie"></i></a>

            <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--CATEGORIA-->
                    <div class="g_margin_bottom_20">
                        <label for="categoria_id">Categoria <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="categoria_id" name="categoria_id" wire:model.live="categoria_id" required>
                            <option value="" selected disabled>Seleccionar una categoria</option>
                            @if ($categorias)
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('categoria_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NIVELES-->
                    <div class="g_margin_bottom_20">
                        <label for="nivel_id">Nivel <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
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

                    <!--CARGOS-->
                    <div class="g_margin_bottom_20">
                        <label for="cargo_id">Cargo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="cargo_id" name="cargo_id" wire:model.live="cargo_id" required>
                            <option value="" selected disabled>Seleccionar un cargo</option>
                            @if ($cargos)
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('cargo_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ELECCIONES-->
                    <div class="g_margin_bottom_20">
                        <label for="eleccion_id">Elección <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="eleccion_id" name="eleccion_id" wire:model.live="eleccion_id" required>
                            <option value="" selected disabled>Seleccionar una elección</option>
                            @if ($elecciones)
                                @foreach ($elecciones as $eleccion)
                                    <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('eleccion_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA INICIO-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_inicio">Fecha inicio <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio"
                            wire:model.live="fecha_inicio" required>
                        @error('fecha_inicio')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA FIN-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_fin">Fecha fin <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" wire:model.live="fecha_fin"
                            required>
                        @error('fecha_fin')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        <p class="leyenda">Se genera automático</p>
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

                    <!--IMAGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="imagen_url">Imagen</label>
                        <input type="text" id="imagen_url" name="imagen_url" wire:model.live="imagen_url">
                        <p class="leyenda">El logo de la elección</p>
                        @error('imagen_url')
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
                    <h4 class="g_panel_titulo">Estado</h4>

                    <!--ESTADO-->
                    <select id="estado" name="estado" wire:model.live="estado" required>
                        <option value="pendiente">PENDIENTE</option>
                        <option value="iniciada">INICIADA</option>
                        <option value="finalizada">FINALIZADA</option>
                    </select>
                    </select>
                    @error('estado')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Alcance</h4>

                    <!--PAIS-->
                    <div class="g_margin_bottom_20">
                        <label for="pais_id">Pais <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="pais_id" name="pais_id" wire:model.live="pais_id" required>
                            <option value="" selected disabled>Seleccionar un pais</option>
                            @if ($paises)
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('pais_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--REGION-->
                    <div class="g_margin_bottom_20">
                        <label for="region_id">Región <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="region_id" name="region_id" wire:model.live="region_id" required>
                            <option value="" selected disabled>Seleccionar una región</option>
                            @if ($regiones)
                                @foreach ($regiones as $region)
                                    <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('region_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PROVINCIA-->
                    <div class="g_margin_bottom_20">
                        <label for="provincia_id">Provincia <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="provincia_id" name="provincia_id" wire:model.live="provincia_id" required>
                            <option value="" selected disabled>Seleccionar una pronvincia</option>
                            @if ($provincias)
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('provincia_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DISTRITO-->
                    <div>
                        <label for="distrito_id">Distrito <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="distrito_id" name="distrito_id" wire:model.live="distrito_id" required>
                            <option value="">Seleccionar un distrito</option>
                            @if ($distritos)
                                @foreach ($distritos as $distrito)
                                    <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('distrito_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="actualizarEncuesta" class="guardar">Actualizar</button>

                <a href="{{ route('admin.encuesta.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>

</div>
