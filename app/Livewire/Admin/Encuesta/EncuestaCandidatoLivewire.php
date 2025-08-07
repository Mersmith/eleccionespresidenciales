<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\CandidatoCargo;
use App\Models\CandidatoEncuesta;
use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaCandidatoLivewire extends Component
{
    use WithPagination;

    public $encuestaId;
    public $encuesta;

    public string $searchDisponibles = '';
    public string $searchAgregados = '';

    public $pageDisponibles = 1;

    public function mount($id)
    {
        $this->encuestaId = $id;
        $this->encuesta = Encuesta::findOrFail($id);
    }

    public function updatingSearchDisponibles()
    {
        $this->resetPage();
        $this->reset('pageDisponibles');
    }

    public function updatingSearchAgregados()
    {
        $this->resetPage();
    }

    public function agregarCandidato($candidatoCargoId)
    {
        CandidatoEncuesta::firstOrCreate([
            'candidato_cargo_id' => $candidatoCargoId,
            'encuesta_id' => $this->encuesta->id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");
    }

    public function quitarCandidato($candidatoCargoId)
    {
        CandidatoEncuesta::where('candidato_cargo_id', $candidatoCargoId)
            ->where('encuesta_id', $this->encuesta->id)
            ->delete();

        $this->dispatch('alertaLivewire', "Eliminado");
    }
    public function render()
    {
        // IDs de los ya agregados
        $idsAgregados = $this->encuesta->candidatoEncuestas->pluck('candidato_cargo_id');

        // Candidatos agregados a esta encuesta
        $candidatosAgregados = CandidatoCargo::with('candidato', 'cargo', 'partido', 'alianza')
            ->whereIn('id', $idsAgregados)
            ->whereHas('candidato', function ($query) {
                $query->where('nombre', 'like', '%' . $this->searchAgregados . '%');
            })
            ->get();

        // Disponibles = los que no han sido asignados aún
        $candidatosDisponibles = CandidatoCargo::with('candidato', 'cargo', 'partido', 'alianza')
            ->whereNotIn('id', $idsAgregados)
            ->where('cargo_id', $this->encuesta->cargo_id)
            ->where(function ($query) {
                $query->where('pais_id', $this->encuesta->pais_id)
                    ->where('region_id', $this->encuesta->region_id)
                    ->where('provincia_id', $this->encuesta->provincia_id)
                    ->where('distrito_id', $this->encuesta->distrito_id);
            })
            ->whereHas('candidato', function ($query) {
                $query->where('nombre', 'like', '%' . $this->searchDisponibles . '%');
            })
            ->paginate(20, ['*'], 'pageDisponibles');

        //dd($candidatosDisponibles);

        return view('livewire.admin.encuesta.encuesta-candidato-livewire', [
            'candidatosAgregados' => $candidatosAgregados,
            'candidatosDisponibles' => $candidatosDisponibles,
        ]);
    }
}
