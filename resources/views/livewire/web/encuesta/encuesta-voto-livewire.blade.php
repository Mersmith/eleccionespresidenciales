<div>
    @if (session()->has('error'))
        <div class="bg-red-200 text-red-800 p-2 mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($yaVoto)
        <div class="text-green-700 font-semibold">
            Ya has votado en esta encuesta.
        </div>
    @else
        <div class="lista_cuadricula_candidatos">
            @foreach ($candidatos as $candidatoCargo)
                <label class="card_candidato {{ $candidato_cargo_id == $candidatoCargo->id ? 'seleccionado' : '' }}">
                    @if ($candidato_cargo_id == $candidatoCargo->id)
                        <div class="overlay_votar">
                            <span wire:click="cerrar" class="boton_cerrar" title="Cerrar">
                                <i class="fas fa-times"></i>
                            </span>
                        
                            <span wire:click="votar" class="boton_votar">
                                Votar
                            </span>
                        </div>
                    @endif

                    <div class="imagen_contenedor">
                        <img class="imagen_candidato" src="{{ $candidatoCargo->candidato->foto }}" alt="Candidato" />
                        <img class="logo_partido" src="{{ $candidatoCargo->candidato->partido->logo }}"
                            alt="Logo partido" />
                    </div>

                    <input type="radio" wire:model.live="candidato_cargo_id" value="{{ $candidatoCargo->id }}">

                    <div class="info_candidato">
                        <strong>{{ $candidatoCargo->candidato->nombre }}</strong>
                        <p>{{ $candidatoCargo->partido?->nombre ?? 'Sin partido' }}</p>
                    </div>
                </label>
            @endforeach
        </div>

    @endif
</div>
