<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Encuesta;

#[Layout('components.layouts.auth')]
class EncuestaLista extends Component
{
    public function render()
    {
        return view('livewire.encuesta-lista', [
            'encuestas' => Encuesta::with('categoria')->latest()->get()
        ]);
    }
}
