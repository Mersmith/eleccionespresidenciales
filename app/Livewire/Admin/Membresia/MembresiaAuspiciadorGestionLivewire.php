<?php

namespace App\Livewire\Admin\Membresia;

use App\Models\Auspiciador;
use App\Models\Membresia;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class MembresiaAuspiciadorGestionLivewire extends Component
{
    use WithPagination;

    public $mesSeleccionado;
    public $buscar = '';
    public $membresiasMes;
    public $perPage = 20;

    public function mount()
    {
        $this->mesSeleccionado = Carbon::now()->format('Y-m');
        $this->loadMembresias();
    }

    public function updatedMesSeleccionado()
    {
        $this->resetPage();
        $this->loadMembresias();
    }

    public function updatedBuscar()
    {
        $this->resetPage();
    }

    public function loadMembresias()
    {
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        $this->membresiasMes = Membresia::where('mes', $mesDate)
            ->get()
            ->keyBy('auspiciador_id');
    }

    public function togglePagadoMes($auspiciadorId)
    {
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        $auspiciador = Auspiciador::with('plan')->findOrFail($auspiciadorId);

        $membresia = Membresia::where('auspiciador_id', $auspiciadorId)
            ->where('mes', $mesDate)
            ->first();

        if ($membresia) {
            $membresia->pagado = !$membresia->pagado;
            $membresia->save();
        } else {
            Membresia::create([
                'auspiciador_id' => $auspiciadorId,
                'mes' => $mesDate,
                'pagado' => true,
                'plan_id' => $auspiciador->plan_id,
                'precio_pagado' => $auspiciador->plan->precio ?? 0.00,
            ]);
        }

        $this->loadMembresias();
    }

    public function render()
    {
        $auspiciadores = Auspiciador::with('plan')
            //->where('activo', true)
            ->where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('nombre')
            ->paginate($this->perPage);

        return view('livewire.admin.membresia.membresia-auspiciador-gestion-livewire', [
            'auspiciadores' => $auspiciadores,
        ]);
    }
}
