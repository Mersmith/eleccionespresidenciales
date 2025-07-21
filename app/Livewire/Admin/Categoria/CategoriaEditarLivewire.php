<?php

namespace App\Livewire\Admin\Categoria;

use App\Models\Categoria;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CategoriaEditarLivewire extends Component
{
    public $categoriaId;
    public $nombre;
    public $descripcion;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'descripcion' => 'descripción',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:categorias,nombre,' . $this->categoriaId,
            'descripcion' => 'required',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',
        'descripcion.required' => 'El :attribute es obligatorio.',
    ];

    public function mount($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
    }

    public function actualizarCategoria()
    {
        $this->validate();

        $categoria = Categoria::findOrFail($this->categoriaId);
        $categoria->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        return redirect()->route('admin.categoria.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.categoria.categoria-editar-livewire');
    }
}
