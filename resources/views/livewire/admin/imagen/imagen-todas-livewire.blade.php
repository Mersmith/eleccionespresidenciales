@section('tituloPagina', 'Imagenes')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Imagenes</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a class="g_boton g_boton_primary">
                <label for="imagenes_inicial" style="cursor: pointer;">Subir <i
                        class="fa-solid fa-square-plus"></i></label>
            </a>
        </div>
    </div>

    <!--FORMULARIO-->
    <form wire:submit.prevent="guardar" class="formulario">
        <div class="g_panel">
            <!--IMAGENES-->
            <div class="g_margin_bottom_20">
                <input type="file" id="imagenes_inicial" wire:model="imagenes_inicial" multiple required
                    accept="image/*" style="display: none;">

                <div class="contenedor_dropzone">
                    @if ($imagenes_final)
                        @foreach ($imagenes_final as $index => $photo)
                            <div class="dropzone_item">
                                <img src="{{ $photo->temporaryUrl() }}" class="dropzone_image">
                                <button type="button" class="remove_button"
                                    wire:click="eliminarImagenTemporal({{ $index }})"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                        @endforeach
                    @else
                        <div class="g_vacio">
                            <p>No hay imagen.</p>
                            <i class="fa-regular fa-face-grin-wink"></i>
                        </div>
                    @endif
                </div>
            </div>
            @if ($imagenes_final)
                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>
                </div>
            @endif
        </div>
    </form>

    <!--MODAL EDITAR-->
    @if ($imagenId)
        <div class="g_modal">
            <div class="modal_contenedor">
                <div class="modal_cerrar">
                    <button wire:click="$set('imagenId', false)"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal_titulo g_titulo">
                    <h2>Nueva Editar</h2>
                </div>

                <div class="modal_cuerpo">
                    <div class="formulario">
                        <!-- URL -->
                        <div class="g_margin_bottom_20" x-data="{ url: '{{ asset($url) }}' }">
                            <label for="titulo">Url</label>
                            <input type="text" id="titulo" name="titulo" :value="url" readonly
                                class="g_margin_bottom_20" disabled>
                            <div class="formulario_botones">
                                <button type="button" class="agregar" @click="navigator.clipboard.writeText(url)">
                                    Copiar
                                </button>
                            </div>
                        </div>

                        <!--TITULO-->
                        <div class="g_margin_bottom_20">
                            <label for="titulo">Titulo <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" id="titulo" name="titulo" wire:model="titulo">
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('titulo')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--DESCRIPCION-->
                        <div class="g_margin_bottom_20">
                            <label for="descripcion">Descripción <span class="obligatorio"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <textarea id="descripcion" name="descripcion" wire:model="descripcion"> </textarea>
                            <p class="leyenda">Se mostrará en el SEO.</p>
                            @error('descripcion')
                                <p class="mensaje_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--IMAGEN-->
                        <div class="g_margin_bottom_20">
                            <label for="descripcion">Imagen</label>

                            <div class="dropzone_item">
                                <img src="{{ $url }}" class="dropzone_image">
                            </div>
                        </div>
                    </div>

                    <div class="cabecera_titulo_botones g_margin_bottom_20">
                        <a class="g_boton g_boton_primary">
                            <label for="imagen_edit" style="cursor: pointer;">Cambiar imagen <i
                                    class="fa-solid fa-square-plus"></i></label>
                        </a>
                        <input type="file" id="imagen_edit" wire:model="imagen_edit" accept="image/*"
                            style="display: none;">
                    </div>

                    <div class="contenedor_dropzone">
                        @if ($imagen_edit)
                            <div class="dropzone_item">
                                <img src="{{ $imagen_edit->temporaryUrl() }}" class="dropzone_image">
                                <button type="button" wire:click="eliminarImagenEditTemporal()"
                                    class="remove_button"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        @else
                            <div class="g_vacio">
                                <p>No hay imagen.</p>
                                <i class="fa-regular fa-face-grin-wink"></i>
                            </div>
                        @endif
                    </div>
                    @error('imagen_edit')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div class="formulario_botones">
                        <button type="button" wire:click="editarFormulario" class="guardar">Actualizar</button>

                        <button type="button" wire:click="$set('imagenId', false)" class="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--TABLA-->
    <div class="g_panel">
        @if ($imagenes->count())
            <div class="grid_instagram g_margin_bottom_20">
                @foreach ($imagenes as $imagen)
                    <div class="item">
                        <div class="contenedor_imagen">
                            <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}" class="imagen">
                        </div>

                        <div class="botones">
                            <a href="{{ $imagen->url }}" target="_blank" class="g_boton g_boton_info"><i
                                    class="fa-solid fa-eye"></i></a>
                            <button type="button" class="g_boton g_boton_danger"
                                @click="navigator.clipboard.writeText('{{ $imagen->url }}')">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                            <button wire:click="seleccionarImagen({{ $imagen->id }})"
                                class="g_boton g_boton_primary"><i class="fa-solid fa-pencil"></i></button>
                            <button
                                wire:click="$dispatch('eliminarImagenAlertaLivewire', { imagenId: {{ $imagen->id }} })"
                                class="g_boton g_boton_danger"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($imagenes->hasPages())
                <div>
                    {{ $imagenes->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>

    @script
        <script>
            Livewire.on('eliminarImagenAlertaLivewire', (imagenId) => {
                Swal.fire({
                    title: '¿Quieres quitar?',
                    text: "No podrás recuparlo.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('eliminarImagen', {
                            imagenId: imagenId
                        });
                    }
                })
            })
        </script>
    @endscript
</div>
