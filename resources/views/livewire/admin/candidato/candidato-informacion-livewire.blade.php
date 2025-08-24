@section('tituloPagina', 'Información')

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
                    <h4 class="g_panel_titulo">Datos personales</h4>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.personales.Nombre">Nombre</label>
                        <input type="text" id="datos_personales.personales.Nombre"
                            name="datos_personales.personales.Nombre"
                            wire:model.live="datos_personales.personales.Nombre">
                        @error('datos_personales.personales.Nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.personales.Edad">Edad</label>
                        <input type="text" id="datos_personales.personales.Edad"
                            name="datos_personales.personales.Edad" wire:model.live="datos_personales.personales.Edad">
                        @error('datos_personales.personales.Edad')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.personales.Profesión">Profesión</label>
                        <input type="text" id="datos_personales.personales.Profesión"
                            name="datos_personales.personales.Profesión"
                            wire:model.live="datos_personales.personales.Profesión">
                        @error('datos_personales.personales.Profesión')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.personales.Ciudad">Ciudad</label>
                        <input type="text" id="datos_personales.personales.Ciudad"
                            name="datos_personales.personales.Ciudad"
                            wire:model.live="datos_personales.personales.Ciudad">
                        @error('datos_personales.personales.Ciudad')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                {{-- Antecedentes --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo">Antecedentes</h4>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.antecedentes.Policiales">Policiales</label>
                        <input type="text" id="datos_personales.antecedentes.Policiales"
                            name="datos_personales.antecedentes.Policiales"
                            wire:model.live="datos_personales.antecedentes.Policiales">
                        @error('datos_personales.antecedentes.Policiales')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.antecedentes.Penales">Penales</label>
                        <input type="text" id="datos_personales.antecedentes.Penales"
                            name="datos_personales.antecedentes.Penales"
                            wire:model.live="datos_personales.antecedentes.Penales">
                        @error('datos_personales.antecedentes.Penales')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="datos_personales.antecedentes.Judiciales">Judiciales</label>
                        <input type="text" id="datos_personales.antecedentes.Judiciales"
                            name="datos_personales.antecedentes.Judiciales"
                            wire:model.live="datos_personales.antecedentes.Judiciales">
                        @error('datos_personales.antecedentes.Judiciales')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                {{-- Material --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo"> Material </h4>

                    <div class="g_margin_bottom_20">
                        <label for="material.Manual">Manual</label>
                        <input type="text" id="material.Manual" name="material.Manual"
                            wire:model.live="material.Manual">
                        @error('material.Manual')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="material.Banner">Banner</label>
                        <input type="text" id="material.Banner" name="material.Banner"
                            wire:model.live="material.Banner">
                        @error('material.Banner')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="material.Gorras">Gorras</label>
                        <input type="text" id="material.Gorras" name="material.Gorras"
                            wire:model.live="material.Gorras">
                        @error('material.Gorras')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="material.General">General</label>
                        <input type="text" id="material.General" name="material.General"
                            wire:model.live="material.General">
                        @error('material.General')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                {{-- Contacto --}}
                <section class="g_panel">
                    <h4 class="g_panel_titulo"> Contacto </h4>

                    <div class="g_margin_bottom_20">
                        <label for="contacto.Celular">Celular</label>
                        <input type="text" id="contacto.Celular" name="contacto.Celular"
                            wire:model.live="contacto.Celular">
                        @error('contacto.Celular')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="contacto.WhatsApp">WhatsApp</label>
                        <input type="text" id="contacto.WhatsApp" name="contacto.WhatsApp"
                            wire:model.live="contacto.WhatsApp">
                        @error('contacto.WhatsApp')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="contacto.Teléfono">Teléfono</label>
                        <input type="text" id="contacto.Teléfono" name="contacto.Teléfono"
                            wire:model.live="contacto.Teléfono">
                        @error('contacto.Teléfono')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="contacto.Correo">Correo</label>
                        <input type="text" id="contacto.Correo" name="contacto.Correo"
                            wire:model.live="contacto.Correo">
                        @error('contacto.Correo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="contacto.Dirección">Dirección</label>
                        <input type="text" id="contacto.Dirección" name="contacto.Dirección"
                            wire:model.live="contacto.Dirección">
                        @error('contacto.Dirección')
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
                                    <span
                                        wire:click="eliminarExperiencia('{{ $tipo }}', {{ $i }})"
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
                            <h4 class="g_panel_titulo">
                                <i class="fa-solid {{ $items[0]['icono'] }}"></i> {{ $tema }}
                            </h4>
                            @foreach ($items as $i => $item)
                                <div class="flex space-x-2 mb-2 items-center">
                                    <input class="flex-1 p-2 border rounded" type="text"
                                        wire:model="propuestas.{{ $tema }}.{{ $i }}.texto">
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
