<div>
    <div>
        <h2>Tipos elecciones</h2>
        <ul>
            @foreach ($tipos_elecciones as $index => $tipo)
            <li class="ml-2 font-semibold text-blue-600">
                <button wire:click="seleccionarTipoEleccion({{ $tipo->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $tipo->id }}- {{ $tipo->nombre }}
                </button>
            </li>
            @endforeach
        </ul>

        @if ($tipoEleccionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Elecciones:
        </h3>
        <ul>
            @forelse ($elecciones as $eleccion)
            <li class="ml-4 text-green-700">
                <button wire:click="seleccionarEleccion({{ $eleccion->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $eleccion->id }}- {{ $eleccion->nombre }}
                </button>
            </li>
            @empty
            <li class="ml-4 text-red-600">No hay cargos.</li>
            @endforelse
        </ul>

        @if ($eleccionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Cargos segun tipo eleccion:
        </h3>

        <ul>
            @foreach ($cargos as $index => $cargo)
            <li class="ml-2 font-semibold text-blue-600">
                <button wire:click="seleccionarCargo({{ $cargo->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $cargo->id }}- {{ $cargo->nombre }}
                </button>
            </li>
            @endforeach
        </ul>
        @if ($cargoSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Regiones con encuestas:
        </h3>
        <ul>
            @foreach ($regiones as $index => $region)
            <li class="ml-2 font-semibold text-blue-600">
                <button wire:click="seleccionarRegion({{ $region->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $region->id }}- {{ $region->nombre }}
                </button>
            </li>
            @endforeach
        </ul>

        @if ($regionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Provincias con encuestas en la región seleccionada:
        </h3>
        <ul>
            @forelse ($provincias as $provincia)
            <li class="ml-4 text-green-700">
                <button wire:click="seleccionarProvincia({{ $provincia->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $provincia->id }}- {{ $provincia->nombre }}
                </button>
            </li>
            @empty
            <li class="ml-4 text-red-600">No hay provincias con encuestas.</li>
            @endforelse
        </ul>

        @if ($provinciaSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Distritos con encuestas en la provincia seleccionada:
        </h3>
        <ul>
            @forelse ($distritos as $distrito)
            <li class="ml-4 text-green-700">
                <button wire:click="seleccionarDistrito({{ $distrito->id }})" class="text-blue-600 hover:underline ml-2">
                    {{ $distrito->id }}- {{ $distrito->nombre }}
                </button>
            </li>
            @empty
            <li class="ml-4 text-red-600">No hay distritos con encuestas.</li>
            @endforelse
        </ul>
        @endif
        @endif
        @endif

        @endif
        @endif
    </div>

    <div>
        <h2>LISTA DE ENCUESTAS</h2>

        @foreach ($encuestas as $index => $item)
        <div class="swiper-slide">
            <div>
                <div class="titulo">{{ $item->nombre }}</div>
                <a href="{{ route('encuesta', ['id' => $item->id, 'slug' => $item->slug]) }}">
                    <div class="contenedor_imagen">
                            <img src="{{ $item->eleccion->imagen_ruta }}"  alt="" style="width: 70px;">                               
                    </div>
                </a>
            </div>
        </div>
    @endforeach
    </div>

</div>
