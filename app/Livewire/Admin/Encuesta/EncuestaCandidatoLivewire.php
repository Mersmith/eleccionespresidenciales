<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Candidato;
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

    public function mount($id)
    {
        $this->encuestaId = $id;
        $this->encuesta = Encuesta::find($id);
    }

    public function updatingSearchDisponibles()
    {
        $this->resetPage();
    }

    public function updatingSearchAgregados()
    {
        $this->resetPage();
    }

    public function agregarCandidato($candidatoId)
    {
        $this->encuesta->candidatos()->syncWithoutDetaching([$candidatoId]);
    }

    public function quitarCandidato($candidatoId)
    {
        $this->encuesta->candidatos()->detach($candidatoId);
    }

    public function render()
    {
        $candidatosAgregados = $this->encuesta->candidatos()
            ->where('nombre', 'like', '%' . $this->searchAgregados . '%')
            ->get();

        $idsAgregados = $candidatosAgregados->pluck('id');

        $candidatosDisponibles = Candidato::whereNotIn('id', $idsAgregados)
            ->where('nombre', 'like', '%' . $this->searchDisponibles . '%')
            ->get();

        return view('livewire.admin.encuesta.encuesta-candidato-livewire', [
            'candidatosAgregados' => $candidatosAgregados,
            'candidatosDisponibles' => $candidatosDisponibles,
        ]);
    }
}
