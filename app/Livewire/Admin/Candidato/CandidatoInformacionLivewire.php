<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoInformacionLivewire extends Component
{
    public $candidato;

    public $datos_personales = [
        'Nombre' => '',
        'Edad' => '',
        'Profesión' => '',
        'Ciudad' => '',
    ];

    public $datos_educativos = [
        'formaciones' => [ // Array de objetos formacion + universidad
            ['formacion' => '', 'universidad' => ''],
        ],
        'cursos_adicionales' => [], // Array de strings
    ];

    public $experiencia_laboral = [
        'Experiencia profesional' => [],
        'Experiencia política' => [],
        'Otros cargos' => [],
    ];

    public $propuestas = [
        'Educación' => [],
        'Salud' => [],
        'Trabajo' => [],
        'Economía' => [],
        'Seguridad' => [],
    ];

    public function mount($id)
    {
        $this->candidato = Candidato::findOrFail($id);

        $this->datos_personales = array_merge(
            $this->datos_personales,
            is_array($this->candidato->datos_personales) ? $this->candidato->datos_personales : []
        );

        $this->datos_educativos = array_merge(
            $this->datos_educativos,
            is_array($this->candidato->datos_educativos) ? $this->candidato->datos_educativos : []
        );

        $this->experiencia_laboral = array_merge(
            $this->experiencia_laboral,
            is_array($this->candidato->experiencia_laboral) ? $this->candidato->experiencia_laboral : []
        );

        $this->propuestas = array_merge(
            $this->propuestas,
            is_array($this->candidato->propuestas) ? $this->candidato->propuestas : []
        );
    }

    public function agregarFormacion()
    {
        $this->datos_educativos['formaciones'][] = ['formacion' => '', 'universidad' => ''];
    }

    public function eliminarFormacion($index)
    {
        unset($this->datos_educativos['formaciones'][$index]);
        $this->datos_educativos['formaciones'] = array_values($this->datos_educativos['formaciones']); // Reindexa
    }

    public function agregarCurso()
    {
        $this->datos_educativos['cursos_adicionales'][] = '';
    }

    public function eliminarCurso($index)
    {
        unset($this->datos_educativos['cursos_adicionales'][$index]);
        $this->datos_educativos['cursos_adicionales'] = array_values($this->datos_educativos['cursos_adicionales']);
    }

    public function agregarExperiencia($tipo)
    {
        $this->experiencia_laboral[$tipo][] = '';
    }

    public function eliminarExperiencia($tipo, $index)
    {
        unset($this->experiencia_laboral[$tipo][$index]);
        $this->experiencia_laboral[$tipo] = array_values($this->experiencia_laboral[$tipo]); // Reindexa
    }

    public function agregarPropuesta($tema)
    {
        $this->propuestas[$tema][] = '';
    }

    public function eliminarPropuesta($tema, $index)
    {
        unset($this->propuestas[$tema][$index]);
        $this->propuestas[$tema] = array_values($this->propuestas[$tema]); // Reindexa
    }

    public function guardar()
    {
        $this->candidato->update([
            'datos_personales' => $this->datos_personales,
            'datos_educativos' => $this->datos_educativos,
            'experiencia_laboral' => $this->experiencia_laboral,
            'propuestas' => $this->propuestas,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-informacion-livewire');
    }
}
