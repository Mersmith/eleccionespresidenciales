<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $encuesta->nombre }}</h1>
    <p class="mb-6 text-gray-600">{{ $encuesta->descripcion }}</p>

    <div class="space-y-4">
        @foreach ($resultados as $item)
            <div class="border p-4 rounded shadow">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">{{ $item['nombre'] }}</span>
                    <span class="text-xl font-bold text-blue-600">{{ $item['votos'] }} votos</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
