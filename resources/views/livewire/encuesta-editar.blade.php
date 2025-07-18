<div class="max-w-2xl mx-auto mt-8">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="actualizar" class="space-y-4">
        <div>
            <label>Título:</label>
            <input type="text" wire:model="titulo" class="w-full border rounded px-2 py-1">
            @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Categoría ID:</label>
            <input type="number" wire:model="categoria_id" class="w-full border rounded px-2 py-1">
            @error('categoria_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Fecha Inicio:</label>
            <input type="datetime-local" wire:model="fecha_inicio" class="w-full border rounded px-2 py-1">
            @error('fecha_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Fecha Fin:</label>
            <input type="datetime-local" wire:model="fecha_fin" class="w-full border rounded px-2 py-1">
            @error('fecha_fin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" wire:model="activa">
                Activa
            </label>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>

            <button type="button" wire:click="eliminar" class="bg-red-500 text-white px-4 py-2 rounded"
                onclick="return confirm('¿Estás seguro de eliminar esta encuesta?')">
                Eliminar
            </button>
        </div>
    </form>
</div>
