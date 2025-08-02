<?php

namespace App\Livewire\Web\Encuesta;

use App\Models\Voto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class EncuestaVotoLivewire extends Component
{
    public $encuesta_id;
    public $candidatos;
    public ?int $candidato_cargo_id = null;
    public bool $yaVoto = false;
    public $modal_votar = false;
    public $modal_voto = false;

    public function mount($encuesta_id, $candidatos)
    {
        $this->encuesta_id = $encuesta_id;
        $this->candidatos = $candidatos;

        if (Auth::check()) {
            $this->yaVoto = Voto::where('user_id', Auth::id())
                ->where('encuesta_id', $this->encuesta_id)
                ->exists();
        }
    }

    public function cerrar()
    {
        $this->candidato_cargo_id = null;
    }

    public function votar()
    {
        if (!Auth::check()) {
            $this->dispatch('modalSesion');
            return;
        }     

        if (!$this->candidato_cargo_id) {
            session()->flash('error', 'Selecciona un candidato para votar.');
            return;
        }

        if(!$this->yaVoto){
            Voto::create([
                'user_id' => Auth::id(),
                'encuesta_id' => $this->encuesta_id,
                'candidato_cargo_id' => $this->candidato_cargo_id,
                'fecha_voto' => now(),
            ]);
    
            $this->yaVoto = true;
    
            $this->modal_votar = true;
        }else{
            $this->modal_voto = true;
        }
    }

    #[On('emitCerrarModalVotar')]
    public function cerrarModalVotar()
    {
        $this->modal_votar = false;
    }

    #[On('emitCerrarModalVoto')]
    public function cerrarModalVoto()
    {
        $this->modal_voto = false;
    }

    public function render()
    {
        return view('livewire.web.encuesta.encuesta-voto-livewire');
    }
}
