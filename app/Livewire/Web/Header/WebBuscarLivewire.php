<?php

namespace App\Livewire\Web\Header;

use App\Models\Candidato;
use Livewire\Component;

class WebBuscarLivewire extends Component
{
    public string $buscar = '';
    public $resultados = [];

    public function updatedBuscar()
    {
        if (strlen(trim($this->buscar)) > 0) {
            $this->resultados = Candidato::where('activo', true)
                ->where('nombre', 'like', '%' . $this->buscar . '%')
                ->limit(10)
                ->get();
        } else {
            $this->resultados = [];
        }
    }

    public function limpiarBusqueda()
    {
        $this->buscar = '';
        $this->resultados = [];
    }

    public function render()
    {
        return view('livewire.web.header.web-buscar-livewire');
    }
}
