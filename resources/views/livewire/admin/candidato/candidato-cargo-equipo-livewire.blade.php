@section('tituloPagina', 'Crear candidato')
<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Equipo de {{ $lider->candidato->nombre }} — {{ $lider->cargo->nombre }}</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_12">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Filtros</h4>

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

                    <div class="g_margin_bottom_20">
                        <label>
                            <input type="checkbox" wire:model.live="filtrarPorPartido">
                            Filtrar por mismo partido (usar partido del líder)
                        </label>

                        <label style="margin-left:1rem;">
                            <input type="checkbox" wire:model.live="filtrarPorAlianza">
                            Filtrar por misma alianza (usar alianza del líder)
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 p-2 rounded">{{ session('message') }}</div>
    @endif

    <!-- Equipo actual -->
    <div class="g_fila">
        <div class="g_columna_6">
            <div class="g_panel">
                <h4 class="g_panel_titulo">Equipo</h4>

                @if ($seleccionados->isEmpty())
                    <p>No tiene equipo.</p>
                @else
                    <ul>
                        @foreach ($seleccionados as $row)
                            @php $integrante = $row->integrante; @endphp
                            <li>
                                {{ $integrante->candidato->nombre ?? '—' }}
                                — {{ $integrante->cargo->nombre ?? '—' }}
                                <button wire:click.prevent="removeIntegrante({{ $integrante->id }})"
                                    class="g_boton_peque">
                                    Quitar
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>


        </div>

        <div class="g_columna_6">
            <div class="g_panel">
                <h4 class="g_panel_titulo">Integrantes disponibles</h4>

                @if ($posibles->isEmpty())
                    <p>No hay candidatos disponibles.</p>
                @else
                    <ul>
                        @foreach ($posibles as $item)
                            <li>
                                {{ $item->candidato->nombre ?? '—' }}
                                — {{ $item->cargo->nombre ?? '—' }}
                                — {{ $item->partido->nombre ?? '' }}

                                <button wire:click.prevent="agregarIntegrante({{ $item->id }})"
                                    class="g_boton_peque">
                                    Agregar
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</div>
