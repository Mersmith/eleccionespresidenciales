<?php

namespace App\Livewire\Admin\Membresia;

use App\Models\Candidato;
use App\Models\Membresia;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class MembresiaGestionLivewire extends Component
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

        // Traer membresías por mes y agrupar por candidato_id
        $this->membresiasMes = Membresia::where('mes', $mesDate)
            ->get()
            ->keyBy('candidato_id');
    }

    public function togglePagadoMes($candidatoId)
    {
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        // Obtener el candidato con su plan
        $candidato = Candidato::with('plan')->findOrFail($candidatoId);

        // Ver si ya existe membresía
        $membresia = Membresia::where('candidato_id', $candidatoId)
            ->where('mes', $mesDate)
            ->first();

        if ($membresia) {
            // Si ya existe, solo toggle pagado
            $membresia->pagado = !$membresia->pagado;
            $membresia->save();
        } else {
            // Crear nueva membresía con plan_id y precio_pagado
            Membresia::create([
                'candidato_id' => $candidatoId,
                'mes' => $mesDate,
                'pagado' => true, // ya que se está marcando como pagado
                'plan_id' => $candidato->plan_id,
                'precio_pagado' => $candidato->plan->precio ?? 0.00, // fallback por si es null
            ]);
        }

        $this->loadMembresias();
    }

    public function render()
    {
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        $candidatos = Candidato::with('plan')
            ->whereHas('plan', fn($q) => $q->where('requiere_pago', true))
            ->where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('nombre')
            ->paginate($this->perPage);

        return view('livewire.admin.membresia.membresia-gestion-livewire', [
            'candidatos' => $candidatos,
        ]);
    }
}
