<?php

namespace App\Livewire\Admin\Eleccion;

use App\Models\Eleccion;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionEditarLivewire extends Component
{
    public $eleccionId;
    public $tipo;
    public $anio;
    public $nombre;
    public $fecha_votacion;

    protected $validationAttributes = [
        'tipo' => 'tipo elección',
        'anio' => 'año',
        'nombre' => 'nombre elección',
        'fecha_votacion' => 'fecha votación',
    ];

    protected function rules()
    {
        return [
            'tipo' => 'required|in:presidencial,municipal',
            'anio' => 'required|integer|min:2024|max:2100',
            'nombre' => 'required|unique:eleccions,nombre,' . $this->eleccionId,
            'fecha_votacion' => 'required|date|after_or_equal:' . $this->anio . '-01-01|before_or_equal:' . $this->anio . '-12-31',
        ];
    }

    protected $messages = [
        'tipo.required' => 'El :attribute es obligatorio.',
        'tipo.in' => 'El :attribute debe ser "presidencial" o "municipal".',

        'anio.required' => 'El :attribute es obligatorio.',
        'anio.integer' => 'El :attribute debe ser un número entero.',
        'anio.min' => 'El :attribute no puede ser menor a 2024.',
        'anio.max' => 'El :attribute no puede ser mayor a 2100.',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'fecha_votacion.required' => 'La :attribute es obligatoria.',
        'fecha_votacion.date' => 'La :attribute debe ser una fecha válida.',
        'fecha_votacion.after_or_equal' => 'La :attribute debe ser desde el 1 de enero del año seleccionado.',
        'fecha_votacion.before_or_equal' => 'La :attribute no puede ser después del 31 de diciembre del año seleccionado.',
    ];

    public function mount($id)
    {
        $this->eleccionId = $id;
        $eleccion = Eleccion::findOrFail($id);

        $this->tipo = $eleccion->tipo;
        $this->anio = date('Y', strtotime($eleccion->fecha));
        $this->nombre = $eleccion->nombre;
        $this->fecha_votacion = $eleccion->fecha;
    }

    public function updatedTipo()
    {
        $this->actualizarNombre();
    }

    public function updatedAnio()
    {
        $this->actualizarNombre();
        $this->reset('fecha_votacion');
    }

    public function actualizarNombre()
    {
        if ($this->tipo && $this->anio) {
            $this->nombre = $this->tipo . ' ' . $this->anio;
        }
    }

    public function actualizarEleccion()
    {
        $this->actualizarNombre();

        $this->validate();

        $eleccion = Eleccion::findOrFail($this->eleccionId);
        $eleccion->update([
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'fecha' => $this->fecha_votacion,
        ]);

        $this->dispatch('alertaLivewire', 'Actualizado correctamente');
        return redirect()->route('admin.eleccion.vista.todas');
    }
    public function render()
    {
        return view('livewire.admin.eleccion.eleccion-editar-livewire');
    }
}
