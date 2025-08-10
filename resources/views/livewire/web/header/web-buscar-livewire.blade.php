<div class="contenedor_menu_buscar">
    <div class="menu_buscar">
        <div class="contenedor_input_buscador_principal">
            <input type="text" placeholder="Busca a tu candidato..." wire:model.live.debounce.300ms="buscar" />
        </div>

        <button wire:click="{{ $buscar ? 'limpiarBusqueda' : '' }}">
            @if ($buscar)
                <i class="fa-solid fa-xmark"></i>
            @else
                <i class="fa-solid fa-magnifying-glass"></i>
            @endif
        </button>
    </div>

    @if (!empty($resultados))
        <div class="resultados_busqueda">
            <ul>
                @forelse($resultados as $candidato)
                    <li>
                        <a href="{{ route('candidato', ['id' => $candidato->id, 'slug' => $candidato->slug]) }}">
                            @if (!empty($candidato->foto))
                                <img src="{{ $candidato->foto }}"
                                    alt="{{ $candidato->nombre }}" class="imagen_candidato">
                            @else
                                <img src="{{ asset('assets/images/partido/partido-1.jpg') }}" alt=""
                                    class="imagen_candidato">
                            @endif
                            {{ $candidato->nombre }}
                        </a>
                    </li>
                @empty
                    <li>No se encontraron resultados.</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
