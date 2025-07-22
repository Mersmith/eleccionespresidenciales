<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Lista de Candidatos Agregados -->
    <div>
        <h2 class="text-lg font-bold mb-2">Candidatos Agregados</h2>
        <input type="text" wire:model.live="searchAgregados" placeholder="Buscar..." class="w-full border p-2 mb-3">

        <ul class="space-y-2">
            @foreach ($candidatosAgregados as $candidato)
                <li class="flex justify-between items-center bg-gray-100 p-2 rounded">
                    <span>{{ $candidato->nombre }}</span>
                    <button wire:click="quitarCandidato({{ $candidato->id }})" class="text-red-600">Quitar</button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Lista de Candidatos Disponibles -->
    <div>
        <h2 class="text-lg font-bold mb-2">Candidatos Disponibles</h2>
        <input type="text" wire:model.live="searchDisponibles" placeholder="Buscar..." class="w-full border p-2 mb-3">

        <ul class="space-y-2">
            @foreach ($candidatosDisponibles as $candidato)
                <li class="flex justify-between items-center bg-gray-100 p-2 rounded">
                    <span>{{ $candidato->nombre }}</span>
                    <button wire:click="agregarCandidato({{ $candidato->id }})" class="text-green-600">Agregar</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
