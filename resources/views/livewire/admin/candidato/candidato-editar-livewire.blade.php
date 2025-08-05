@section('tituloPagina', 'Editar Candidato')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Editar candidato</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.cargo.editar', $candidato->id) }}" class="g_boton g_boton_primary">
                Cargo <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('admin.candidato.social.editar', $candidato->id) }}" class="g_boton g_boton_primary">
                Social <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_darkt">
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
                        <label for="descripcion">Descripcion <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FOTO-->
                    <div class="g_margin_bottom_20">
                        <label for="foto">Foto <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="foto" name="foto" wire:model.live="foto" required>
                        @error('foto')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PARTIDO-->
                    <div class="g_margin_bottom_20">
                        <label for="partido_id">Partido <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="partido_id" name="partido_id" wire:model.live="partido_id" required>
                            <option value="" selected disabled>Seleccionar un partido</option>
                            @if ($partidos)
                                @foreach ($partidos as $partido)
                                    <option value="{{ $partido->id }}">{{ $partido->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('partido_id')
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
                    <h4 class="g_panel_titulo">Vive</h4>

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
                <button wire:click="actualizarPartido" class="guardar">Guardar</button>

                <a href="{{ route('admin.candidato.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        <!--TABLA CONTENIDO-->
        <div class="tabla_contenido g_margin_bottom_20">
            <div class="contenedor_tabla">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Cargo</th>
                            <th>Elección</th>
                            <th>Partido o Alianza</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $index => $item)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td class="g_resaltar">{{ $item->cargo->nombre }}</td>
                                <td>{{ $item->eleccion->nombre }}</td>
                                <td>
                                    @if ($item->partido)
                                        {{ $item->partido->nombre }}
                                    @elseif ($item->alianza)
                                        {{ $item->alianza->nombre }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $item->region->nombre ?? '-' }}
                                    {{ $item->provincia->nombre ?? '' }}
                                    {{ $item->distrito->nombre ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
