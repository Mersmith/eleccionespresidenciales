<div>
    <div>
        <button wire:click="limpiarFiltros" type="button" class="px-3 py-1 bg-gray-300 text-black rounded">
            Limpiar filtros
        </button>

        <h2>Tipos elecciones</h2>

        <select wire:model.live="tipoEleccionSeleccionada">
            <option value="">Selecciona tipo de elección</option>
            @foreach ($tipos_elecciones as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
            @endforeach
        </select>


        @if ($tipoEleccionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Elecciones:
        </h3>

        <select wire:model.live="eleccionSeleccionada">
            <option value="">Selecciona elección</option>
            @foreach ($elecciones as $eleccion)
            <option value="{{ $eleccion->id }}">{{ $eleccion->nombre }}</option>
            @endforeach
        </select>
        @endif

        @if ($eleccionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Cargos segun tipo eleccion:
        </h3>

        <select wire:model.live="cargoSeleccionada">
            <option value="">Selecciona cargo</option>
            @foreach ($cargos as $cargo)
            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
            @endforeach
        </select>
        @endif


        @if ($cargoSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Regiones con encuestas:
        </h3>


        <select wire:model.live="regionSeleccionada">
            <option value="">Selecciona region</option>
            @foreach ($regiones as $region)
            <option value="{{ $region->id }}">{{ $region->nombre }}</option>
            @endforeach
        </select>
        @endif

        @if ($regionSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Provincias con encuestas en la región seleccionada:
        </h3>

        <select wire:model.live="provinciaSeleccionada">
            <option value="">Selecciona provincia</option>
            @foreach ($provincias as $provincia)
            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
            @endforeach
        </select>
        @endif

        @if ($provinciaSeleccionada)
        <h3 class="text-lg font-semibold text-gray-700">
            Distritos con encuestas en la provincia seleccionada:
        </h3>

        <select wire:model.live="distritoSeleccionada">
            <option value="">Selecciona distrito</option>
            @foreach ($distritos as $distrito)
            <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
            @endforeach
        </select>
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
                        <img src="{{ $item->eleccion->imagen_ruta }}" alt="" style="width: 70px;">
                    </div>
                </a>
            </div>
        </div>
        @endforeach

        {{ $encuestas->links() }}
    </div>

</div>
