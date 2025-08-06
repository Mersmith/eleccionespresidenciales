<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class PlanEditarLivewire extends Component
{
    public $plan;

    public $nombre;
    public $precio;
    public $descripcion;
    public $requiere_pago;

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

    public function mount($id)
    {
        $this->plan = Plan::findOrFail($id);

        $this->nombre = $this->plan->nombre;
        $this->precio = $this->plan->precio;
        $this->descripcion = $this->plan->descripcion;
        $this->requiere_pago = $this->plan->requiere_pago;
    }

    public function actualizarPlan()
    {
        $this->validate();

        $this->plan->update([
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'descripcion' => $this->descripcion,
            'requiere_pago' => $this->requiere_pago,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.plan.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.plan.plan-editar-livewire');
    }
}
