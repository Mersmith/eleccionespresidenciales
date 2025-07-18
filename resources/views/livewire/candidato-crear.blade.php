<div>
    <form wire:submit.prevent="save">
        <div>
            <label>Nombre</label>
            <input type="text" wire:model="nombre" class="form-control">
        </div>

        <div>
            <label>Descripción</label>
            <textarea wire:model="descripcion" class="form-control"></textarea>
        </div>

        <div>
            <label>Foto (URL)</label>
            <input type="text" wire:model="foto" class="form-control">
        </div>


        <button class="btn btn-success mt-2">Guardar</button>
    </form>
</div>
