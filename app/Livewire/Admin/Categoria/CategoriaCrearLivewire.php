<?php

namespace App\Livewire\Admin\Categoria;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Categoria;

#[Layout('components.layouts.admin.layout-admin')]
class CategoriaCrearLivewire extends Component
{
    public $nombre, $descripcion;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'descripcion' => 'descripcion',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:categorias,nombre',
            'descripcion' => 'required',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'descripcion.required' => 'El :attribute es obligatorio.',
    ];

    public function crearCategoria()
    {
        $this->validate();

        Categoria::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.categoria.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.categoria.categoria-crear-livewire');
    }
}
