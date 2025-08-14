@section('tituloPagina', 'Editar post')

<div>
    <!-- CABECERA -->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Editar post</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('admin.post.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>
            <a href="{{ route('admin.post.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!-- FORMULARIO -->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!-- Titulo -->
                    <div class="g_margin_bottom_20">
                        <label for="titulo">Titulo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="titulo" wire:model.live="titulo" required>
                        @error('titulo')
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


                    <!-- Imagen -->
                    <div class="g_margin_bottom_20">
                        <label for="image">Imagen <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="image" wire:model.live="image" required>
                        @error('image')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <!-- Titulo -->
                    <div class="g_margin_bottom_20">
                        <label for="meta_title">Meta titulo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="meta_title" wire:model.live="meta_title" required>
                        @error('meta_title')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="meta_description">Meta descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="meta_description" wire:model.live="meta_description" rows="3"></textarea>
                        @error('meta_description')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <!-- Content -->
                    <div wire:ignore style="g_ckeditor">
                        <label for="content">Contenido</label>
                        <textarea id="content" class="w-full form-control" rows="6" wire:ignore x-data x-init="ClassicEditor.create($refs.miEditor, {
                                toolbar: [
                                    'undo', 'redo', '|',
                                    'heading', '|',
                                    'bold', 'italic', '|',
                                    'link', 'uploadImage', 'insertTable', 'blockQuote',
                                    'mediaEmbed', '|',
                                    'bulletedList', 'numberedList', '|',
                                    'outdent', 'indent'
                                ],
                                ckfinder: {
                                    uploadUrl: '{{ route('admin.post.upload') }}?_token={{ csrf_token() }}'
                                },
                                link: {
                                    addTargetToExternalLinks: true,
                                    defaultProtocol: 'https://'
                                }
                            })
                            .then(editor => {
                                editor.model.document.on('change:data', () => {
                                    @this.set('content', editor.getData())
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });"
                            x-ref="miEditor">{!! $content !!}</textarea>

                        @error('content')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="g_columna_4">
                <!-- Activo -->
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Activo</h4>
                    <select id="activo" wire:model="activo">
                        <option value="0">DESACTIVADO</option>
                        <option value="1">ACTIVO</option>
                    </select>
                    @error('activo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Partido -->
                <div class="g_panel">
                    <div class="g_margin_bottom_20">
                        <label for="partido_id">Partido</label>
                        <select id="partido_id" wire:model="partido_id">
                            <option value="">Seleccionar un partido</option>
                            @foreach ($partidos as $partido)
                                <option value="{{ $partido->id }}">{{ $partido->nombre }}</option>
                            @endforeach
                        </select>
                        @error('partido_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alianza -->
                    <div class="g_margin_bottom_20">
                        <label for="alianza_id">Alianza</label>
                        <select id="alianza_id" wire:model="alianza_id">
                            <option value="">Seleccionar una alianza</option>
                            @foreach ($alianzas as $alianza)
                                <option value="{{ $alianza->id }}">{{ $alianza->nombre }}</option>
                            @endforeach
                        </select>
                        @error('alianza_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Candidato -->
                    <div class="g_margin_bottom_20">
                        <label for="candidato_id">Candidato</label>
                        <select id="candidato_id" wire:model="candidato_id">
                            <option value="">Seleccionar un candidato</option>
                            @foreach ($candidatos as $candidato)
                                <option value="{{ $candidato->id }}">{{ $candidato->nombre }}</option>
                            @endforeach
                        </select>
                        @error('candidato_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($errors->has('relacionados'))
                        <p class="mensaje_error">{{ $errors->first('relacionados') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- BOTONES -->
    <div class="formulario_botones">
        <button wire:click="actualizarPost" class="guardar" wire:loading.attr="disabled">Guardar</button>
        <a href="{{ route('admin.post.vista.todas') }}" class="cancelar">Cancelar</a>
    </div>

</div>
