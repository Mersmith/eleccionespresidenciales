<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class PlanTodasLivewire extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $planes = Plan::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.plan.plan-todas-livewire', compact('planes'));
    }
}
