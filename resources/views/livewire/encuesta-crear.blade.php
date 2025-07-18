<div class="p-4 max-w-lg mx-auto">
    @if (session()->has('mensaje'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="crearEncuesta" class="space-y-4">
        <div>
            <label class="block">Título:</label>
            <input type="text" wire:model="titulo" class="w-full border rounded p-2">
            @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Categoría:</label>
            <select wire:model="categoria_id" class="w-full border rounded p-2">
                <option value="">-- Selecciona --</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Fecha de Inicio:</label>
            <input type="datetime-local" wire:model="fecha_inicio" class="w-full border rounded p-2">
            @error('fecha_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Fecha de Fin:</label>
            <input type="datetime-local" wire:model="fecha_fin" class="w-full border rounded p-2">
            @error('fecha_fin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" wire:model="activa" class="mr-2">
            <label>Encuesta activa</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Crear Encuesta</button>
    </form>
</div>
