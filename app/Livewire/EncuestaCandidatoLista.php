<?php

namespace App\Livewire;

use App\Models\Candidato;
use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('components.layouts.auth')]
class EncuestaCandidatoLista extends Component
{
    use WithPagination;

    public Encuesta $encuesta;

    #[Url]
    public string $searchDisponibles = '';

    #[Url]
    public string $searchAgregados = '';

    public function mount($id)
    {
        $this->encuesta = Encuesta::findOrFail($id);
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

        return view('livewire.encuesta-candidato-lista', [
            'candidatosAgregados' => $candidatosAgregados,
            'candidatosDisponibles' => $candidatosDisponibles,
        ]);
    }
}
