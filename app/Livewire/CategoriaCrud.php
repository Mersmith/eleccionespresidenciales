<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CategoriaCrud extends Component
{
    use WithPagination;

    public $categoriaId, $nombre, $descripcion;
    public $modoEditar = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ];

    public function resetCampos()
    {
        $this->reset(['categoriaId', 'nombre', 'descripcion', 'modoEditar']);
    }

    public function guardar()
    {
        $this->validate();

        Categoria::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('mensaje', '¡Categoría creada exitosamente!');
        $this->resetCampos();
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
        $this->modoEditar = true;
    }

    public function actualizar()
    {
        $this->validate();

        Categoria::where('id', $this->categoriaId)->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('mensaje', '¡Categoría actualizada exitosamente!');
        $this->resetCampos();
    }

    public function eliminar($id)
    {
        Categoria::destroy($id);
        session()->flash('mensaje', '¡Categoría eliminada!');
    }

    public function render()
    {
        $categorias = Categoria::latest()->paginate(10);
        return view('livewire.categoria-crud', compact('categorias'));
    }
}
