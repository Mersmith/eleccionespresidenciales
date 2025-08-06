@section('tituloPagina', 'Agregar equipo')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Agregar equipo de {{ $lider->candidato->nombre }} — {{ $lider->cargo->nombre }}</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.cargo.equipo.editar', $lider->candidato->id) }}"
                class="g_boton g_boton_primary">
                Ver equipo <i class="fa-solid fa-eye"></i></a>

            <a href="{{ route('admin.candidato.vista.editar', $lider->candidato->id) }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
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
                        <!--PARTIDO-->
                        <div class="g_columna_12">
                            <div>
                                <div class="boton_checkbox boton_checkbox_deshabilitado">
                                    <label for="filtrarPorPartido">Mismo partido</label>
                                    <input type="checkbox" id="filtrarPorPartido" name="filtrarPorPartido"
                                        wire:model.live="filtrarPorPartido">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="g_fila">
                        <!--ALIANZA-->
                        <div class="g_columna_12">
                            <div>
                                <div class="boton_checkbox boton_checkbox_deshabilitado">
                                    <label for="filtrarPorAlianza">Mismo alianza</label>
                                    <input type="checkbox" id="filtrarPorAlianza" name="filtrarPorAlianza"
                                        wire:model.live="filtrarPorAlianza">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($posibles->count())
            <div class="tabla_cabecera">
                <!-- TABLA CABECERA BUSCAR -->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.300ms="buscar" id="buscar" name="buscar"
                            placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <!-- TABLA CONTENIDO -->
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Partido</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posibles as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->candidato->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->cargo->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->partido?->nombre }}</td>
                                    <td>
                                        <button wire:click.prevent="agregarIntegrante({{ $item->id }})"
                                            class="g_boton g_boton_primary">
                                            Agregar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $posibles->links() }}
            </div>
        @else
            <div class="g_vacio">
                <p>No hay candidatos disponibles.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
