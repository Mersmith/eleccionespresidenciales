<div>
    <div>
        <div>
            <h2>{{ $encuesta->nombre }}</h2>
            <h2>{{ $encuesta->nivel->nombre }}</h2>
            <h2>{{ $encuesta->cargo->nombre }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


        <!-- Lista de Candidatos Agregados -->
        <div>
            <h2 class="text-lg font-bold mb-2">Candidatos Agregados</h2>
            <input type="text" wire:model.live="searchAgregados" placeholder="Buscar..." class="w-full border p-2 mb-3">

            <ul class="space-y-2">
                @foreach($candidatosAgregados as $postulacion)
                <div>
                    {{ $postulacion->candidato->nombre }} - {{ $postulacion->cargo->nombre }} - {{ $postulacion->partido?->nombre ?? 'Sin partido' }}
                    <button wire:click="quitarCandidato({{ $postulacion->id }})">Quitar</button>
                </div>
                @endforeach
            </ul>
        </div>

        <!-- Lista de Candidatos Disponibles -->
        <div>
            <h2 class="text-lg font-bold mb-2">Candidatos Disponibles</h2>
            <input type="text" wire:model.live="searchDisponibles" placeholder="Buscar..." class="w-full border p-2 mb-3">

            <ul class="space-y-2">
                @foreach($candidatosDisponibles as $postulacion)
                <div>
                    {{ $postulacion->candidato->nombre }} - {{ $postulacion->cargo->nombre }} - {{ $postulacion->partido?->nombre ?? 'Sin partido' }}
                    <button wire:click="agregarCandidato({{ $postulacion->id }})">Agregar</button>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>
