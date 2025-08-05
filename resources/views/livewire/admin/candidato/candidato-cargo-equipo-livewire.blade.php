<div class="space-y-6">
    <h2 class="text-xl font-bold">Equipo de {{ $lider->candidato->nombre }} — {{ $lider->cargo->nombre }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 p-2 rounded">{{ session('message') }}</div>
    @endif

    <!-- Equipo actual -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Equipo actual</h3>
        @if ($lider->equipo->isEmpty())
            <p>No tiene integrantes.</p>
        @else
            <ul>
                @foreach ($lider->equipo as $row)
                    <li class="flex items-center justify-between py-2">
                        <div>
                            <strong>{{ $row->integrante->candidato->nombre }}</strong>
                            — {{ $row->integrante->cargo->nombre }}
                            @if($row->rol) <span class="ml-2 text-sm">({{ $row->rol }})</span> @endif
                        </div>
                        <div class="flex gap-2">
                            <button wire:click="removeIntegrante({{ $row->integrante->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Quitar</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Formulario selección de integranes -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Agregar / editar integrantes</h3>

        <form wire:submit.prevent="save" class="space-y-3">
            <div>
                <label class="block text-sm font-medium">Selecciona integrantes</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-64 overflow-auto border rounded p-2">
                    @foreach ($posibles as $p)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="seleccionados" value="{{ $p->id }}">
                            <span>{{ $p->candidato->nombre }} — {{ $p->cargo->nombre }}</span>
                            <!-- campo rol para este integrante -->
                            <input type="text" wire:model="roles.{{ $p->id }}" placeholder="Rol (opcional)" class="ml-4 border px-2 py-1" />
                            <input type="number" wire:model="ordenes.{{ $p->id }}" placeholder="Orden" class="ml-2 w-20 border px-2 py-1" />
                        </label>
                    @endforeach
                </div>
                @error('seleccionados') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Guardar equipo</button>
            </div>
        </form>
    </div>
</div>
