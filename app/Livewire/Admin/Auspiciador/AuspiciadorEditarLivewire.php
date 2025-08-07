<?php

namespace App\Livewire\Admin\Auspiciador;

use App\Models\Auspiciador;
use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class AuspiciadorEditarLivewire extends Component
{
    public $auspiciador;

    public $planes = [];
    public $nombre;
    public $empresa;
    public $celular;
    public $observacion;
    public $plan_id;
    public $activo;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'empresa' => 'empresa',
        'celular' => 'celular',
        'observacion' => 'observacion',
        'plan_id' => 'plan',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'empresa' => 'nullable',
            'celular' => 'nullable',
            'observacion' => 'nullable|min:3|max:255',
            'plan_id' => 'required',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount($id)
    {
        $this->auspiciador = Auspiciador::findOrFail($id);

        $this->nombre = $this->auspiciador->nombre;
        $this->empresa = $this->auspiciador->empresa;
        $this->celular = $this->auspiciador->celular;
        $this->observacion = $this->auspiciador->observacion;
        $this->plan_id = $this->auspiciador->plan_id ?? '';
        $this->activo = $this->auspiciador->activo;

        $this->planes = Plan::all();
    }

    public function actualizarAuspiciador()
    {
        $this->validate();

        $this->auspiciador->update([
            'nombre' => $this->nombre,
            'empresa' => $this->empresa,
            'celular' => $this->celular,
            'observacion' => $this->observacion,
            'plan_id' => $this->plan_id,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.auspiciador.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.auspiciador.auspiciador-editar-livewire');
    }
}
