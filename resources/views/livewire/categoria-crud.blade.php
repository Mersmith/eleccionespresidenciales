<div>
    <h2 class="section-title">Gestión de Categorías</h2>

    @if (session()->has('mensaje'))
        <div class="alert alert-success">
            {{-- Using an Alpine.js component for dismissable alerts is great here --}}
            <div x-data="{ open: true }" x-show="open" class="alert-content">
                {{ session('mensaje') }}
                <button type="button" @click="open = false" class="alert-close-btn">&times;</button>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="{{ $modoEditar ? 'actualizar' : 'guardar' }}" class="form-container">
        <div class="form-group">
            <input type="text" wire:model.live="nombre" placeholder="Nombre de la categoría" class="form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}">
            @error('nombre') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <textarea wire:model.live="descripcion" placeholder="Descripción de la categoría (opcional)" class="form-textarea {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"></textarea>
            @error('descripcion') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ $modoEditar ? 'Actualizar Categoría' : 'Crear Categoría' }}
            </button>

            @if($modoEditar)
                <button type="button" wire:click="resetCampos" class="btn btn-text-link">Cancelar</button>
            @endif
        </div>
    </form>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr class="table-header-row">
                    <th class="table-header-cell">ID</th>
                    <th class="table-header-cell">Nombre</th>
                    <th class="table-header-cell">Descripción</th>
                    <th class="table-header-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $cat)
                    <tr wire:key="{{ $cat->id }}">
                        <td class="table-cell">{{ $cat->id }}</td>
                        <td class="table-cell">{{ $cat->nombre }}</td>
                        <td class="table-cell">{{ $cat->descripcion }}</td>
                        <td class="table-actions-cell">
                            <button wire:click="editar({{ $cat->id }})" class="btn btn-icon btn-edit" title="Editar Categoría">
                                <i class="fas fa-pencil-alt"></i> </button>
                            <button wire:click="eliminar({{ $cat->id }})" class="btn btn-icon btn-delete" wire:confirm="¿Estás seguro de que quieres eliminar esta categoría?" title="Eliminar Categoría">
                                <i class="fas fa-trash-alt"></i> </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="table-cell table-no-data">No hay categorías para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-controls">
        {{ $categorias->links() }}
    </div>
</div>