<div>
    <h2 class="text-xl font-bold mb-4">Gestión de Categorías</h2>

    @if (session()->has('mensaje'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $modoEditar ? 'actualizar' : 'guardar' }}" class="mb-4">
        <input type="text" wire:model="nombre" placeholder="Nombre" class="border p-2 w-full mb-2">
        <textarea wire:model="descripcion" placeholder="Descripción" class="border p-2 w-full mb-2"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $modoEditar ? 'Actualizar' : 'Crear' }}
        </button>

        @if($modoEditar)
            <button type="button" wire:click="resetCampos" class="ml-2 text-sm underline">Cancelar</button>
        @endif
    </form>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $cat)
                <tr>
                    <td class="p-2 border">{{ $cat->id }}</td>
                    <td class="p-2 border">{{ $cat->nombre }}</td>
                    <td class="p-2 border">{{ $cat->descripcion }}</td>
                    <td class="p-2 border">
                        <button wire:click="editar({{ $cat->id }})" class="text-blue-600">Editar</button>
                        <button wire:click="eliminar({{ $cat->id }})" class="text-red-600 ml-2" onclick="confirm('¿Eliminar?') || event.stopImmediatePropagation()">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>
</div>
