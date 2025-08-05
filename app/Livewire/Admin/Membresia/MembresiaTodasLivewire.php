<?php

namespace App\Livewire\Admin\Membresia;

use App\Models\Candidato;
use App\Models\Membresia;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class MembresiaTodasLivewire extends Component
{

    // Inputs / state
    public $mesSeleccionado; // formato Y-m (ej: "2025-08")
    public $candidato_id;
    public $mes; // para el formulario (Y-m)
    public $pagado = false;
    public $editId = null;

    // Datos cargados
    public $membresias; // histórico completo (collection)
    public $membresiasMes; // membresías del mes seleccionado (keyBy candidato_id)
    public $candidatosConPago; // candidatos cuyo plan requiere pago (collection)

    public function mount()
    {
        // Por defecto mes actual
        $this->mesSeleccionado = Carbon::now()->format('Y-m');
        $this->loadData();
    }

    /**
     * Carga todos los datos necesarios según el mes seleccionado.
     */
    public function loadData()
    {
        // Historial completo (opcional, para la tabla de histórico)
        $this->membresias = Membresia::with('candidato')->orderBy('mes', 'desc')->get();

        // Convertir mes seleccionado Y-m -> YYYY-MM-01 para comparar con columna DATE
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        // Membresías del mes seleccionado, keyBy candidato_id para lookup rápido
        $this->membresiasMes = Membresia::with('candidato')
            ->where('mes', $mesDate)
            ->get()
            ->keyBy('candidato_id');

        // Candidatos que tienen un plan que requiere pago
        $this->candidatosConPago = Candidato::with('plan')
            ->whereHas('plan', function ($q) {
                $q->where('requiere_pago', true);
            })
            ->orderBy('nombre')
            ->get();
    }

    // Cuando cambie el selector month en la UI
    public function updatedMesSeleccionado($value)
    {
        $this->loadData();
    }

    /**
     * Guardar o actualizar una membresía desde el formulario.
     * Usa updateOrCreate por candidato_id + mes.
     */
    public function save()
    {
        $this->validate([
            'candidato_id' => 'required|exists:candidatos,id',
            'mes' => 'required|date_format:Y-m',
        ]);

        $mesDate = Carbon::createFromFormat('Y-m', $this->mes)->startOfMonth()->toDateString();

        Membresia::updateOrCreate(
            ['candidato_id' => $this->candidato_id, 'mes' => $mesDate],
            ['pagado' => (bool) $this->pagado]
        );

        $this->resetInput();
        $this->loadData();
    }

    /**
     * Cargar datos al formulario para editar una membresía existente.
     */
    public function edit($id)
    {
        $m = Membresia::findOrFail($id);

        $this->editId = $m->id;
        $this->candidato_id = $m->candidato_id;
        $this->mes = Carbon::parse($m->mes)->format('Y-m'); // para input type=month
        $this->pagado = (bool) $m->pagado;
    }

    /**
     * Eliminar membresía.
     */
    public function delete($id)
    {
        Membresia::destroy($id);
        $this->loadData();
    }

    /**
     * Toggle rápido: marcar/desmarcar pagado para un candidato en el mes seleccionado.
     * Crea la membresía si no existía.
     */
    public function togglePagadoMes($candidatoId)
    {
        $mesDate = Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->startOfMonth()->toDateString();

        $m = Membresia::firstOrCreate(
            ['candidato_id' => $candidatoId, 'mes' => $mesDate],
            ['pagado' => false]
        );

        $m->pagado = !$m->pagado;
        $m->save();

        $this->loadData();
    }

    protected function resetInput()
    {
        $this->reset(['candidato_id', 'mes', 'pagado', 'editId']);
    }

    public function render()
    {
        return view('livewire.admin.membresia.membresia-todas-livewire', [
            'candidatos' => $this->candidatosConPago, // para la lista por mes
            'membresias' => $this->membresias, // histórico completo
            'membresiasMes' => $this->membresiasMes,
            'mesSeleccionado' => $this->mesSeleccionado,
        ]);
    }
}
