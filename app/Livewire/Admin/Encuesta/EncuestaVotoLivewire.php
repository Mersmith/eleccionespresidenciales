<?php

namespace App\Livewire\Admin\Encuesta;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Voto;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaVotoLivewire extends Component
{
    public Encuesta $encuesta;
    public ?int $selectedCandidatoId = null;
    public bool $yaVoto = false;

    public function mount($id)
    {
        $this->encuesta = Encuesta::with('candidatos')->findOrFail($id);

        if (Auth::check()) {
            $this->yaVoto = Voto::where('user_id', Auth::id())
                ->where('encuesta_id', $this->encuesta->id)
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

        if (!$this->selectedCandidatoId) {
            session()->flash('error', 'Selecciona un candidato para votar.');
            return;
        }

        Voto::create([
            'user_id' => Auth::id(),
            'encuesta_id' => $this->encuesta->id,
            'candidato_id' => $this->selectedCandidatoId,
            'fecha_voto' => now(),
        ]);

        $this->yaVoto = true;

        session()->flash('success', '¡Voto registrado correctamente!');
    }

    public function render()
    {
        return view('livewire.admin.encuesta.encuesta-voto-livewire', [
            'candidatos' => $this->encuesta->candidatos,
        ]);
    }
}
