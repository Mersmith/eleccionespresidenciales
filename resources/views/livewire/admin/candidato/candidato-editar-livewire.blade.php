@section('tituloPagina', 'Candidato')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear candidato</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.cargo.editar', $candidatoId) }}" class="g_boton g_boton_primary">
                Cargo <i class="fa-solid fa-square-plus"></i></a>

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
                        <label for="nombre">Nombre <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre" required>
                        @error('nombre')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripcion <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" wire:model.live="descripcion" rows="3"></textarea>
                        @error('descripcion')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LOGO-->
                    <div class="g_margin_bottom_20">
                        <label for="foto">Foto <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="foto" name="foto" wire:model.live="foto" required>
                        @error('foto')
                        <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--PARTIDO-->
                    <div class="g_margin_bottom_20">
                        <label for="partido_id">Partido <span class="obligatorio"><i class="fa-solid fa-asterisk"></i></span></label>
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

                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="crearPartido" class="guardar">Guardar</button>

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
                            <th>Partido</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $index => $item)
                        <tr>
                            <td> {{ $index + 1 }} </td>
                            <td class="g_resaltar">{{ $item->cargo->nombre  }}</td>
                            <td>{{ $item->eleccion->nombre }}</td>
                            <td>{{ $item->partido->nombre }}</td>
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
