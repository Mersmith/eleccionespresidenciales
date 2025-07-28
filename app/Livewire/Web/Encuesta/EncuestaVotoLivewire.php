<?php

namespace App\Livewire\Web\Encuesta;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Voto;
use Illuminate\Support\Facades\Auth;

class EncuestaVotoLivewire extends Component
{
    public $encuesta_id;
    public $candidatos;
    public ?int $candidato_cargo_id = null;
    public bool $yaVoto = false;

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

    public function votar()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para votar.');
            return;
        }

        if ($this->yaVoto) {
            session()->flash('error', 'Ya has votado en esta encuesta.');
            return;
        }

        if (!$this->candidato_cargo_id) {
            session()->flash('error', 'Selecciona un candidato para votar.');
            return;
        }

        Voto::create([
            'user_id' => Auth::id(),
            'encuesta_id' => $this->encuesta_id,
            'candidato_cargo_id' => $this->candidato_cargo_id,
            'fecha_voto' => now(),
        ]);

        $this->yaVoto = true;

        session()->flash('success', '¡Voto registrado correctamente!');
    }

    public function render()
    {
        return view('livewire.web.encuesta.encuesta-voto-livewire');
    }
}
