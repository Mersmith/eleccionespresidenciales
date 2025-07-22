<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Partido;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoEditarLivewire extends Component
{
    public $candidatoId;

    public $nombre, $descripcion, $foto, $partido_id = "";
    public $partidos;

    public $historial = [];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'descripcion' => 'descripción',
        'foto' => 'foto',
        'partido_id' => 'partido',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:candidatos,nombre,' . $this->candidatoId,
            'descripcion' => 'required',
            'foto' => 'required',
            'partido_id' => 'required',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'descripcion.required' => 'El :attribute es obligatorio.',

        'foto.required' => 'El :attribute es obligatorio.',

        'partido_id.required' => 'El :attribute es obligatorio.',
    ];

    public function mount($id)
    {
        $this->candidatoId = $id;
        $candidato = Candidato::findOrFail($id);

        $this->nombre = $candidato->nombre;
        $this->descripcion = $candidato->descripcion;
        $this->foto = $candidato->foto;
        $this->partido_id = $candidato->partido_id;

        $this->partidos = Partido::all();

        $this->cargarHistorial();
    }

    public function crearPartido()
    {
        $this->validate();

        $candidato = Candidato::findOrFail($this->candidatoId);
        $candidato->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
            'partido_id' => $this->partido_id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.candidato.vista.todas');
    }

    public function cargarHistorial()
    {
        $this->historial = CandidatoCargo::with(['cargo', 'eleccion', 'partido', 'region', 'provincia', 'distrito'])
            ->where('candidato_id', $this->candidatoId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-editar-livewire');
    }
}
