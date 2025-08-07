<?php

namespace App\Livewire\Admin\Auspiciador;

use App\Models\Auspiciador;
use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class AuspiciadorCrearLivewire extends Component
{
 
    public $planes = [];

    public $nombre;
    public $empresa;
    public $celular;
    public $observacion;
    public $plan_id = "";
    public $activo = "0";

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

    public function mount()
    {
        $this->planes = Plan::all();
    }    

    public function crearAuspiciador()
    {
        $this->validate();

        Auspiciador::create([
            'nombre' => $this->nombre,
            'empresa' => $this->empresa,
            'celular' => $this->celular,
            'observacion' => $this->observacion,
            'plan_id' => $this->plan_id,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.auspiciador.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.auspiciador.auspiciador-crear-livewire');
    }
}
