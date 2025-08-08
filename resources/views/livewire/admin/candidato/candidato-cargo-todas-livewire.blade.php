@section('tituloPagina', 'Candidato')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Candidato cargos</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="#" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="#" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--FORMULARIO-->
    {{-- <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Filtros</h4>

                    <div class="g_fila g_margin_bottom_20">
                        <!--NIVELES-->
                        <div class="g_columna_4">
                            <div>
                                <label for="nivel_id">Nivel</label>
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

                        <!--CARGOS-->
                        <div class="g_columna_4">
                            <div>
                                <label for="cargo_id">Cargo</label>
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
                        </div>

                        <!--PAIS-->
                        <div class="g_columna_4">
                            <div>
                                <label for="pais_id">Pais</label>
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
                        </div>

                    </div>

                    <div class="g_fila">
                        <!--REGION-->
                        <div class="g_columna_4">
                            <div>
                                <label for="region_id">Región</label>
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
                        </div>

                        <!--PROVINCIA-->
                        <div class="g_columna_4">
                            <div>
                                <label for="provincia_id">Provincia</label>
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
                        </div>

                        <!--DISTRITO-->
                        <div class="g_columna_4">
                            <div>
                                <label for="distrito_id">Distrito</label>
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
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <div class="g_fila g_margin_bottom_20">
                        <!--ACTIVO-->
                        <div class="g_columna_6">
                            <div>
                                <label for="distrito_id">Activo</label>
                                <select id="activo" name="activo" wire:model.live="activo">
                                    <option value="0" selected>TODOS</option>
                                    <option value="0" selected>DESACTIVADO</option>
                                    <option value="1">ACTIVO</option>
                                </select>
                            </div>
                        </div>
                        <!--ESTADO-->
                        <div class="g_columna_6">
                            <div>
                                <label for="distrito_id">Estado</label>
                                <select id="estado" name="estado" wire:model.live="estado" required>
                                    <option value="">TODOS</option>
                                    <option value="pendiente">PENDIENTE</option>
                                    <option value="iniciada">INICIADA</option>
                                    <option value="finalizada">FINALIZADA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="g_fila">
                        <!--FECHA-->
                        <div class="g_columna_6">
                            <!-- Fecha Inicio Desde -->
                            <div>
                                <label for="fecha_inicio_desde">Desde</label>
                                <input type="date" id="fecha_inicio_desde" wire:model.live="fecha_inicio_desde">
                            </div>
                        </div>
                        <div class="g_columna_6">
                            <!-- Fecha Inicio Hasta -->
                            <div>
                                <label for="fecha_inicio_hasta">Hasta</label>
                                <input type="date" id="fecha_inicio_hasta" wire:model.live="fecha_inicio_hasta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!--TABLA-->
    <div class="g_panel">
        <div class="tabla_cabecera">
            <div class="tabla_cabecera_buscar">
                <form action="">
                    <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar"
                        placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>
        @if ($candito_cargos->count())
            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Candidato</th>
                                <th>Cargo</th>
                                <th>Nivel</th>
                                <th>Elección</th>
                                <th>Partido</th>
                                <th>Alianza</th>
                                <th>Número</th>
                                <th>Pais</th>
                                <th>Región</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Principal</th>
                                <th>Electo</th>
                                <th>Activo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candito_cargos as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->candidato->nombre ?? '' }}</td>
                                    <td>{{ $item->cargo->nombre ?? '' }}</td>
                                    <td>{{ $item->nivel->nombre ?? '' }}</td>
                                    <td>{{ $item->eleccion->nombre ?? '' }}</td>
                                    <td>{{ $item->partido->nombre ?? '' }}</td>
                                    <td>{{ $item->alianza->nombre ?? '' }}</td>
                                    <td>{{ $item->numero ?? '' }}</td>
                                    <td>{{ $item->pais->nombre ?? '' }}</td>
                                    <td>{{ $item->region->nombre ?? '' }}</td>
                                    <td>{{ $item->provincia->nombre ?? '' }}</td>
                                    <td>{{ $item->distrito->nombre ?? '' }}</td>
                                    <td>
                                        <span class="{{ $item->principal ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->principal ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $item->electo ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->electo ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('admin.candidato.vista.editar', $item->candidato->id) }}"
                                            class="g_accion_editar">
                                            <span><i class="fa-solid fa-pencil"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            @if ($candito_cargos->hasPages())
                <div>
                    {{ $candito_cargos->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay encuestas disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
