<div class="max-w-6xl mx-auto px-4 py-6">
    <!-- Títulos principales -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $encuesta->nombre }}</h2>
        <h2 class="text-xl text-gray-600">{{ $encuesta->nivel->nombre }}</h2>
        <h2 class="text-xl text-gray-600">{{ $encuesta->cargo->nombre }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lista de Candidatos Agregados -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h2 class="text-lg font-semibold text-blue-700 mb-4">Candidatos Agregados</h2>
            <input
                type="text"
                wire:model.live="searchAgregados"
                placeholder="Buscar..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:ring focus:ring-blue-200 focus:outline-none"
            />

            <ul class="space-y-3">
                @foreach($candidatosAgregados as $postulacion)
                    <li class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex justify-between items-center">
                        <span class="text-gray-800">
                            {{ $postulacion->candidato->nombre }} - 
                            {{ $postulacion->cargo->nombre }} - 
                            {{ $postulacion->partido?->nombre ?? 'Sin partido' }}
                        </span>
                        <button
                            wire:click="quitarCandidato({{ $postulacion->id }})"
                            class="text-sm text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg"
                        >
                            Quitar
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Lista de Candidatos Disponibles -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h2 class="text-lg font-semibold text-green-700 mb-4">Candidatos Disponibles</h2>
            <input
                type="text"
                wire:model.live="searchDisponibles"
                placeholder="Buscar..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:ring focus:ring-green-200 focus:outline-none"
            />

            <ul class="space-y-3">
                @foreach($candidatosDisponibles as $postulacion)
                    <li class="bg-green-50 border border-green-200 rounded-lg p-4 flex justify-between items-center">
                        <span class="text-gray-800">
                            {{ $postulacion->candidato->nombre }} - 
                            {{ $postulacion->cargo->nombre }} - 
                            {{ $postulacion->partido?->nombre ?? 'Sin partido' }}
                        </span>
                        <button
                            wire:click="agregarCandidato({{ $postulacion->id }})"
                            class="text-sm text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg"
                        >
                            Agregar
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
