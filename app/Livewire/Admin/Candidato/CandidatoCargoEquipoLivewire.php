<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\CandidatoCargo;
use App\Models\CandidatoCargoEquipo;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoEquipoLivewire extends Component
{
    public CandidatoCargo $lider; // la postulación líder
    public $posibles = []; // postulaciones disponibles para integrar
    public $seleccionados = []; // ids de candidato_cargo seleccionados
    public $roles = []; // mapa id => rol (opcional)
    public $ordenes = []; // mapa id => orden (opcional)

    public function mount($id)
    {
        $this->lider = CandidatoCargo::with(['candidato', 'cargo', 'eleccion'])->findOrFail($id);
        $this->loadPosibles();

        //dd($this->posibles);
        $this->loadSeleccionados();
    }

    protected function loadPosibles()
    {
        // Filtrar postulaciones que pueden integrarse:
        // - misma elección
        // - distinto id
        // (añade más filtros según tu negocio: cargo permitido, territorio, etc.)
        $this->posibles = CandidatoCargo::with(['candidato', 'cargo'])
            ->where('eleccion_id', $this->lider->eleccion_id)
            ->where('id', '!=', $this->lider->id)
            ->orderBy('cargo_id')
            ->get();
    }

    protected function loadSeleccionados()
    {
        // cargar los integrantes actuales del líder desde la tabla equipo
        $this->seleccionados = $this->lider
            ->equipo() // si usas hasMany -> CandidatoCargoEquipo model, ajusta abajo
            ->get()
            ->pluck('integrante_candidato_cargo_id')
            ->map(fn($v) => (int) $v)
            ->toArray();

        // cargar roles y ordenes existentes para llenar inputs si editas
        $this->roles = [];
        $this->ordenes = [];
        foreach ($this->lider->equipo as $row) {
            $this->roles[$row->integrante_candidato_cargo_id] = $row->rol;
            $this->ordenes[$row->integrante_candidato_cargo_id] = $row->orden;
        }
    }

    public function updatedSeleccionados()
    {
        // Si quieres, cuando cambie la selección, hacer algo
    }

    public function save()
    {
        // validaciones básicas
        if (in_array($this->lider->id, $this->seleccionados)) {
            $this->addError('seleccionados', 'No puede agregarse a sí mismo como integrante.');
            return;
        }

        // validar que los seleccionados pertenecen a la misma elección
        $posiblesIds = $this->posibles->pluck('id')->toArray();
        foreach ($this->seleccionados as $selId) {
            if (!in_array($selId, $posiblesIds)) {
                $this->addError('seleccionados', 'Seleccionaste una postulación inválida.');
                return;
            }
        }

        DB::transaction(function () {
            // Opción A: sincronizar (borrar lo que no está y crear/actualizar los que sí)
            // Primero borrar los registros que quedaron fuera de la selección
            CandidatoCargoEquipo::where('lider_candidato_cargo_id', $this->lider->id)
                ->whereNotIn('integrante_candidato_cargo_id', $this->seleccionados)
                ->delete();

            // Luego insertar / actualizar los seleccionados
            foreach ($this->seleccionados as $integranteId) {
                $pivotData = [
                    'rol' => $this->roles[$integranteId] ?? null,
                    'orden' => $this->ordenes[$integranteId] ?? null,
                ];

                CandidatoCargoEquipo::updateOrCreate(
                    [
                        'lider_candidato_cargo_id' => $this->lider->id,
                        'integrante_candidato_cargo_id' => $integranteId,
                    ],
                    $pivotData
                );
            }
        });

        // recargar datos
        $this->lider->load('equipo.integrante.candidato', 'equipo.integrante.cargo'); // recargar relaciones
        $this->loadPosibles();
        $this->loadSeleccionados();

        session()->flash('message', 'Equipo guardado correctamente.');
    }

    public function removeIntegrante($integranteId)
    {
        CandidatoCargoEquipo::where('lider_candidato_cargo_id', $this->lider->id)
            ->where('integrante_candidato_cargo_id', $integranteId)
            ->delete();

        $this->lider->load('equipo.integrante.candidato', 'equipo.integrante.cargo');
        $this->loadPosibles();
        $this->loadSeleccionados();
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-equipo-livewire', [
            // $posibles ya es collection cargada en mount; pero la pasamos por si quieres paginar
            'posibles' => $this->posibles,
        ]);
    }
}
