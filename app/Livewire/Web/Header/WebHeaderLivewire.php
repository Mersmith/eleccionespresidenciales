<?php

namespace App\Livewire\Web\Header;

use App\Models\Cargo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WebHeaderLivewire extends Component
{
    public $tipo_eleccion_id = null;
    public $eleccion_id = null;

    public $cargos;
    public $cargo_id = null;
    public $cargo_nivel_id = null;

    public $regiones;
    public $region_id = null;

    public $provincias = [];
    public $provincia_id = null;

    public $distritos = [];

    public $modal_sesion = false;

    public function mount()
    {
        $this->cargos = Cargo::all();
    }

    public function seleccionarCargo($cargo_id)
    {
        $cargo = Cargo::find($cargo_id);

        if ($cargo->tipo_eleccion_id == config('constantes.TIPO_ELECCION_GENERAL_ID')) {
            $this->tipo_eleccion_id = config('constantes.TIPO_ELECCION_GENERAL_ID');
            $this->eleccion_id = config('constantes.ELECCION_GENERAL_ID');
        } elseif ($cargo->tipo_eleccion_id == config('constantes.TIPO_ELECCION_REGIONAL_ID')) {
            $this->tipo_eleccion_id = config('constantes.TIPO_ELECCION_REGIONAL_ID');
            $this->eleccion_id = config('constantes.ELECCION_REGIONAL_ID');
        }

        $this->cargo_id = $cargo_id;
        $this->cargo_nivel_id = $cargo->nivel_id;

        return redirect()->route('encuestas', [
            'tipoEleccionSeleccionada' => $this->tipo_eleccion_id,
            'eleccionSeleccionada' => $this->eleccion_id,
            'cargoSeleccionada' => $this->cargo_id,
        ]);
    }

    public function abrirModalSesion()
    {
        if (!Auth::check()) {
            $this->modal_sesion = true;
        } else {
            return redirect()->route('perfil');
        }
    }

    public function cerrarModalSesion()
    {
        $this->modal_sesion = false;
    }

    public function render()
    {
        return view('livewire.web.header.web-header-livewire');
    }
}
