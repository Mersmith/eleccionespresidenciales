<div class="max-w-xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Votación: {{ $encuesta->titulo }}</h2>

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
        <form wire:submit.prevent="votar">
            <div class="space-y-4">
                @foreach ($candidatos as $candidato)
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model="selectedCandidatoId" value="{{ $candidato->id }}">
                        <span>{{ $candidato->nombre }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Votar
            </button>
        </form>
    @endif
</div>
