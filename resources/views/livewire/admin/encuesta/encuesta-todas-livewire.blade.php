 @section('tituloPagina', 'Encuestas')

 @section('anchoPantalla', '100%')

 <div>
     <!--CABECERA TITULO PAGINA-->
     <div class="g_panel cabecera_titulo_pagina">
         <!--TITULO-->
         <h2>Encuestas</h2>

         <!--BOTONES-->
         <div class="cabecera_titulo_botones">
             <a href="{{ route('admin.encuesta.vista.todas') }}" class="g_boton g_boton_light">
                 Inicio <i class="fa-solid fa-house"></i></a>

             <a href="{{ route('admin.encuesta.vista.crear') }}" class="g_boton g_boton_primary">
                 Crear <i class="fa-solid fa-square-plus"></i></a>
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
     </div>

     <!--TABLA-->
     <div class="g_panel">
         @if ($encuestas->count())
             <div class="tabla_cabecera">
                 <div class="tabla_cabecera_buscar">
                     <form action="">
                         <input type="text" wire:model.live.debounce.1300ms="buscar" id="buscar" name="buscar"
                             placeholder="Buscar...">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </form>
                 </div>
             </div>

             <!--TABLA CONTENIDO-->
             <div class="tabla_contenido g_margin_bottom_20">
                 <div class="contenedor_tabla">
                     <table class="tabla">
                         <thead>
                             <tr>
                                 <th>Nº</th>
                                 {{-- <th>Elección</th>
                                 <th>Imagen</th> --}}
                                 <th>Nombre</th>
                                 <th>Cargo</th>
                                 <th>Nivel</th>
                                 <th>Pais</th>
                                 <th>Región</th>
                                 <th>Provincia</th>
                                 <th>Distrito</th>
                                 <th>Fecha Inicio</th>
                                 <th>Fecha Fin</th>
                                 <th>Estado</th>
                                 <th>Activo</th>
                                 <th>Acción</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($encuestas as $item)
                                 <tr>
                                     <td>{{ $loop->iteration }}</td>
                                     {{-- <td class="g_inferior">ID: {{ $item->eleccion->id }} -
                                         {{ $item->eleccion->nombre ?? '-' }}</td>
                                     <td><img src="{{ $item->imagen_url }}"></td> --}}
                                     <td class="g_resaltar">{{ $item->nombre }}</td>
                                     <td>{{ $item->cargo->nombre ?? '' }}</td>
                                     <td>{{ $item->nivel->nombre ?? '' }}</td>
                                     <td>{{ $item->pais->nombre ?? '' }}</td>
                                     <td>{{ $item->region->nombre ?? '' }}</td>
                                     <td>{{ $item->provincia->nombre ?? '' }}</td>
                                     <td>{{ $item->distrito->nombre ?? '' }}</td>
                                     <td>{{ $item->fecha_inicio }}</td>
                                     <td>
                                         <span class="{{ $item->ya_finalizo ? 'g_desactivado g_negrita' : '' }}">
                                             {{ $item->fecha_fin }}
                                         </span>
                                     </td>
                                     <td>
                                         <span
                                             class="g_boton
                                        @if ($item->estado === 'pendiente') g_boton_info
                                        @elseif($item->estado === 'iniciada') g_boton_success
                                        @elseif($item->estado === 'finalizada') g_boton_danger @endif ">
                                             {{ ucfirst($item->estado) }}
                                         </span>
                                     </td>
                                     <td>
                                         <span class="estado {{ $item->activo ? 'g_activo' : 'g_desactivado' }}"><i
                                                 class="fa-solid fa-circle"></i></span>
                                         {{ $item->activo ? 'Activo' : 'Desactivo' }}
                                     </td>
                                     <td class="centrar_iconos">
                                         <a href="{{ route('admin.encuesta.vista.editar', $item->id) }}"
                                             class="g_accion_editar">
                                             <span><i class="fa-solid fa-pencil"></i></span>
                                         </a>
                                         <a href="{{ route('admin.encuesta.candidato.editar', $item->id) }}"
                                             class="g_resaltar">
                                             <span><i class="fa-solid fa-user-tie"></i></span>
                                         </a>
                                         <a href="{{ route('encuesta', $item->id) }}" class="g_activo"
                                             target="_blank">
                                             <span><i class="fa-solid fa-check-to-slot"></i></span>
                                         </a>
                                         <a href="{{ route('encuesta.resultado', $item->id) }}" class="g_accion_ver"
                                             target="_blank">
                                             <span><i class="fa-solid fa-chart-simple"></i></span>
                                         </a>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>

                 </div>
             </div>

             @if ($encuestas->hasPages())
                 <div>
                     {{ $encuestas->onEachSide(1)->links() }}
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
