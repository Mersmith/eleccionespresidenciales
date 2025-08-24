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
        'personales' => [
            'Nombre'     => '',
            'Edad'       => '',
            'Profesión'  => '',
            'Ciudad'     => '',
        ],
        'antecedentes' => [
            'Policiales' => '', // URL o ruta del PDF
            'Penales'    => '', // URL o ruta del PDF
            'Judiciales' => '', // URL o ruta del PDF
        ],
    ];

    public $material = [
        'Manual' => '',
        'Banner' => '',
        'Gorras' => '',
        'General' => '',
    ];

    public $contacto = [
        'Celular' => '',
        'WhatsApp' => '',
        'Teléfono' => '',
        'Correo' => '',
        'Dirección' => '',
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
        'Educación' => [
            ['texto' => '', 'icono' => 'fa-book'],
        ],
        'Salud' => [
            ['texto' => '', 'icono' => 'fa-heartbeat'],
        ],
        'Trabajo' => [
            ['texto' => '', 'icono' => 'fa-briefcase'],
        ],
        'Economía' => [
            ['texto' => '', 'icono' => 'fa-coins'],
        ],
        'Seguridad' => [
            ['texto' => '', 'icono' => 'fa-shield-halved'],
        ],
        'Lucha contra la corrupción' => [
            ['texto' => '', 'icono' => 'fa-user-secret'],
        ],
        'Justicia y Estado de derecho' => [
            ['texto' => '', 'icono' => 'fa-gavel'],
        ],
        'Medio ambiente y cambio climático' => [
            ['texto' => '', 'icono' => 'fa-leaf'],
        ],
        'Tecnología e innovación' => [
            ['texto' => '', 'icono' => 'fa-laptop-code'],
        ],
        'Infraestructura y transporte' => [
            ['texto' => '', 'icono' => 'fa-train'],
        ],
        'Política exterior y relaciones internacionales' => [
            ['texto' => '', 'icono' => 'fa-globe'],
        ],
        'Agricultura y desarrollo rural' => [
            ['texto' => '', 'icono' => 'fa-tractor'],
        ],
        'Igualdad de género y derechos humanos' => [
            ['texto' => '', 'icono' => 'fa-venus-mars'],
        ],
        'Juventud y deporte' => [
            ['texto' => '', 'icono' => 'fa-futbol'],
        ],
        'Turismo y cultura' => [
            ['texto' => '', 'icono' => 'fa-theater-masks'],
        ],
        'Vivienda y urbanismo' => [
            ['texto' => '', 'icono' => 'fa-house'],
        ],
        'Energía y recursos naturales' => [
            ['texto' => '', 'icono' => 'fa-bolt'],
        ],
        'Pueblos indígenas y comunidades originarias' => [
            ['texto' => '', 'icono' => 'fa-feather'],
        ],
    ];

    public function mount($id)
    {
        $this->candidato = Candidato::findOrFail($id);

        $this->datos_personales = array_merge(
            $this->datos_personales,
            is_array($this->candidato->datos_personales) ? $this->candidato->datos_personales : []
        );

        $this->material = array_merge(
            $this->material,
            is_array($this->candidato->material) ? $this->candidato->material : []
        );

        $this->contacto = array_merge(
            $this->contacto,
            is_array($this->candidato->contacto) ? $this->candidato->contacto : []
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
        $this->propuestas[$tema][] = ['texto' => '', 'icono' => 'fa-circle-check'];
    }

    public function eliminarPropuesta($tema, $index)
    {
        unset($this->propuestas[$tema][$index]);
        $this->propuestas[$tema] = array_values($this->propuestas[$tema]);
    }

    public function guardar()
    {
        $this->candidato->update([
            'datos_personales' => $this->datos_personales,
            'material' => $this->material,
            'contacto' => $this->contacto,
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
