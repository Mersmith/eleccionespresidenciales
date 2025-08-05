<div class="space-y-6">
    <!-- Selector de mes -->
    <div class="flex items-center gap-4">
        <label class="font-semibold">Mes:</label>
        <input type="month" wire:model.live="mesSeleccionado" class="border rounded px-2 py-1" />

        <div class="ml-auto">
            <button wire:click="loadData" class="px-3 py-1 bg-gray-200 rounded">Refrescar</button>
        </div>
    </div>

    <br>

    <!-- LISTA RÁPIDA: candidatos que requieren pago -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-3">Candidatos que requieren pago — {{ $mesSeleccionado }}</h3>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="text-left">
                    <th class="py-2">Candidato</th>
                    <th class="py-2">Estado</th>
                    <th class="py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidatos as $c)
                    @php $m = $membresiasMes[$c->id] ?? null; @endphp
                    <tr class="border-t">
                        <td class="py-2">{{ $c->nombre }}</td>
                        <td class="py-2">
                            @if ($m)
                                {{ $m->pagado ? '✅ Pagado' : '❌ No pagado' }}
                            @else
                                — (sin registro)
                            @endif
                        </td>
                        <td class="py-2">
                            <button wire:click="togglePagadoMes({{ $c->id }})"
                                class="px-2 py-1 rounded bg-blue-500 text-white">
                                {{ $m && $m->pagado ? 'Desmarcar pago' : 'Marcar pagado' }}
                            </button>

                            @if ($m)
                                <button wire:click="edit({{ $m->id }})"
                                    class="px-2 py-1 rounded bg-yellow-400 text-black">Editar</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4">No hay candidatos que requieran pago.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <br>

    <!-- FORMULARIO MANUAL: crear / editar membresía -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-3">{{ $editId ? 'Editar Membresía' : 'Registrar Membresía' }}</h3>

        <form wire:submit.prevent="save" class="space-y-3">
            <div>
                <label class="block text-sm">Candidato</label>
                <select wire:model.live="candidato_id" class="border px-2 py-1 rounded w-full">
                    <option value="">-- Seleccione candidato --</option>
                    @foreach ($candidatos as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                    @endforeach
                </select>
                @error('candidato_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm">Mes</label>
                <input type="month" wire:model.live="mes" class="border px-2 py-1 rounded w-full" />
                @error('mes')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model.live="pagado" id="pagado">
                <label for="pagado">Pagado</label>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Guardar</button>
                <button type="button" wire:click="resetInput" class="px-3 py-1 bg-gray-300 rounded">Limpiar</button>
            </div>
        </form>
    </div>

    <br>

    <!-- HISTORIAL COMPLETO -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-3">Historial de Membresías</h3>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="text-left">
                    <th class="py-2">Candidato</th>
                    <th class="py-2">Mes</th>
                    <th class="py-2">Pagado</th>
                    <th class="py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($membresias as $m)
                    <tr class="border-t">
                        <td class="py-2">{{ $m->candidato->nombre }}</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($m->mes)->format('Y-m') }}</td>
                        <td class="py-2">{{ $m->pagado ? '✅' : '❌' }}</td>
                        <td class="py-2">
                            <button wire:click="edit({{ $m->id }})"
                                class="px-2 py-1 rounded bg-yellow-400">Editar</button>
                            <button wire:click="delete({{ $m->id }})"
                                class="px-2 py-1 rounded bg-red-500 text-white">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4">No hay membresías registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
