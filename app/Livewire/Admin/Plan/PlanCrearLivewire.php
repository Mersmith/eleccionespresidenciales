<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class PlanCrearLivewire extends Component
{
    public $nombre, $precio, $descripcion, $requiere_pago = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'precio' => 'precio',
        'descripcion' => 'descripción',
        'requiere_pago' => 'requiere pago',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required|min:3|max:255',
            'requiere_pago' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function crearPlan()
    {
        $this->validate();

        Plan::create([
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'descripcion' => $this->descripcion,
            'requiere_pago' => $this->requiere_pago,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.plan.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.plan.plan-crear-livewire');
    }
}
