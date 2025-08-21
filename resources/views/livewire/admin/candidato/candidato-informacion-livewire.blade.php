@section('tituloPagina', 'Red Social')

@section('anchoPantalla', '100%')

<div>

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Información</h2>

        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.candidato.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>

            <a href="{{ route('admin.candidato.vista.editar', $candidato->id) }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_6">
                {{-- Datos personales --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo"> Datos personales </h4>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.Nombre">Nombre</label>
                        <input type="text" id="datos_personales.Nombre" name="datos_personales.Nombre"
                            wire:model.live="datos_personales.Nombre">
                        @error('datos_personales.Nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.Edad">Edad</label>
                        <input type="text" id="datos_personales.Edad" name="datos_personales.Nombre"
                            wire:model.live="datos_personales.Edad">
                        @error('datos_personales.Edad')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.Profesión">Profesión</label>
                        <input type="text" id="datos_personales.Profesión" name="datos_personales.Profesión"
                            wire:model.live="datos_personales.Profesión">
                        @error('datos_personales.Profesión')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.Ciudad">Ciudad</label>
                        <input type="text" id="datos_personales.Ciudad" name="datos_personales.Ciudad"
                            wire:model.live="datos_personales.Ciudad">
                        @error('datos_personales.Ciudad')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </section>


                {{-- Datos educativos --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo"> Datos educativos </h4>

                    {{-- Formaciones --}}
                    @foreach ($datos_educativos['formaciones'] as $index => $item)
                        <div class="flex space-x-2 mb-2 items-center">
                            <input class="flex-1 p-2 border rounded" type="text"
                                wire:model.live="datos_educativos.formaciones.{{ $index }}.formacion"
                                placeholder="Formación académica">
                            <input class="flex-1 p-2 border rounded" type="text"
                                wire:model.live="datos_educativos.formaciones.{{ $index }}.universidad"
                                placeholder="Universidad">
                            <span wire:click="eliminarFormacion({{ $index }})"
                                class="g_boton g_boton_danger">Eliminar</span>
                        </div>
                    @endforeach
                    <span wire:click="agregarFormacion" class="g_boton g_boton_success">Agregar</span>

                    {{-- Cursos adicionales --}}
                    <h4 class="font-semibold mt-4">Cursos adicionales</h4>
                    @foreach ($datos_educativos['cursos_adicionales'] as $index => $curso)
                        <div class="flex space-x-2 mb-2 items-center">
                            <input class="flex-1 p-2 border rounded" type="text"
                                wire:model.live="datos_educativos.cursos_adicionales.{{ $index }}"
                                placeholder="Curso adicional {{ $index + 1 }}">
                            <span wire:click="eliminarCurso({{ $index }})"
                                class="g_boton g_boton_danger">Eliminar</span>
                        </div>
                    @endforeach
                    <span wire:click="agregarCurso" class="g_boton g_boton_success">Agregar</span>
                </section>

                {{-- Experiencia laboral --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo"> Experiencia laboral </h4>
                    @foreach (['Experiencia profesional', 'Experiencia política', 'Otros cargos'] as $tipo)
                        <div class="g_panel">

                            <h4 class="font-semibold mt-2">{{ $tipo }}</h4>
                            @foreach ($experiencia_laboral[$tipo] as $i => $exp)
                                <div class="flex space-x-2 mb-2 items-center">
                                    <input class="flex-1 p-2 border rounded" type="text"
                                        wire:model.live="experiencia_laboral.{{ $tipo }}.{{ $i }}">
                                    <span wire:click="eliminarExperiencia('{{ $tipo }}', {{ $i }})"
                                        class="g_boton g_boton_danger">Eliminar</span>
                                </div>
                            @endforeach
                            <span wire:click="agregarExperiencia('{{ $tipo }}')"
                                class="g_boton g_boton_success">Agregar</span>
                        </div>
                    @endforeach
                </section>

            </div>

            <div class="g_columna_6">

                {{-- Propuestas --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo">Propuestas </h4>
                    @foreach ($propuestas as $tema => $items)
                        <div class="g_panel">

                            <h4 class="g_panel_titulo">{{ $tema }}</h4>
                            @foreach ($items as $i => $item)
                                <div class="flex space-x-2 mb-2 items-center">
                                    <input class="flex-1 p-2 border rounded" type="text"
                                        wire:model.live="propuestas.{{ $tema }}.{{ $i }}">
                                    <span wire:click="eliminarPropuesta('{{ $tema }}', {{ $i }})"
                                        class="g_boton g_boton_danger">Eliminar</span>
                                </div>
                            @endforeach
                            <span wire:click="agregarPropuesta('{{ $tema }}')"
                                class="g_boton g_boton_success">Agregar</span>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="guardar" class="guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
