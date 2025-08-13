<?php

namespace App\Livewire\Admin\Anuncio;

use App\Models\Alianza;
use App\Models\Anuncio;
use App\Models\Auspiciador;
use App\Models\Candidato;
use App\Models\Partido;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class AnuncioEditarLivewire extends Component
{

    public $anuncio;

    public $auspiciadores = [], $candidatos = [], $partidos = [], $alianzas = [];
    public $auspiciador_id = null;
    public $candidato_id = null;
    public $partido_id = null;
    public $alianza_id = null;

    public $pagina;
    public $fecha_inicio;
    public $fecha_fin;
    public $nombre;
    public $url_imagen;
    public $link;
    public $activo = 0;

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:anuncios,nombre,' . $this->anuncio->id,
            'url_imagen' => 'required|url',
            'link' => 'nullable|url',
            'auspiciador_id' => 'nullable|exists:auspiciadors,id',
            'candidato_id' => 'nullable|exists:candidatos,id',
            'partido_id' => 'nullable|exists:partidos,id',
            'alianza_id' => 'nullable|exists:alianzas,id',
            'pagina' => ['nullable', Rule::in(['inicio', 'candidato', 'partido', 'alianza', 'encuesta', 'resultado'])],
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'activo' => 'required|boolean',
        ];

    }

    public function mount($id)
    {
        $this->anuncio = Anuncio::findOrFail($id);

        $this->nombre = $this->anuncio->nombre;
        $this->url_imagen = $this->anuncio->url_imagen;
        $this->pagina = $this->anuncio->pagina;
        $this->fecha_inicio = $this->anuncio->fecha_inicio;
        $this->fecha_fin = $this->anuncio->fecha_fin;
        $this->link = $this->anuncio->link;
        $this->activo = $this->anuncio->activo;
        $this->auspiciador_id = $this->anuncio->auspiciador_id;
        $this->candidato_id = $this->anuncio->candidato_id;
        $this->partido_id = $this->anuncio->partido_id;
        $this->alianza_id = $this->anuncio->alianza_id;

        $this->auspiciadores = Auspiciador::all();
        $this->candidatos = Candidato::all();
        $this->partidos = Partido::all();
        $this->alianzas = Alianza::where('activo', true)->get();
    }

    public function editarAnuncio()
    {
        $this->validate();

        $relacionados = [
            $this->auspiciador_id,
            $this->candidato_id,
            $this->partido_id,
            $this->alianza_id,
        ];

        // Cuenta cuántos tienen valor distinto de null o vacío
        $seleccionados = collect($relacionados)->filter(fn($v) => !is_null($v) && $v !== '')->count();

        if ($seleccionados !== 1) {
            $this->addError('relacionados', 'Debe seleccionar exactamente uno entre auspiciador, candidato, partido o alianza.');
            return;
        }

        $this->anuncio->update([
            'nombre' => $this->nombre,
            'url_imagen' => $this->url_imagen,
            'link' => $this->link,
            'auspiciador_id' => $this->auspiciador_id,
            'candidato_id' => $this->candidato_id,
            'partido_id' => $this->partido_id,
            'alianza_id' => $this->alianza_id,
            'pagina' => $this->pagina,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        return redirect()->route('admin.anuncio.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.anuncio.anuncio-editar-livewire');
    }
}
