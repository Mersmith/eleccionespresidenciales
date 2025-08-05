<?php

namespace App\Livewire\Admin\Alianza;

use App\Models\Alianza;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class AlianzaSocialLivewire extends Component
{
    public $alianza;

    public $contenido = [];

    protected $rules = [
        'contenido.*.icono' => 'required|string|max:255',
        'contenido.*.color' => 'required|string|max:1000',
        'contenido.*.url' => 'nullable|string|max:1000',
    ];

    protected $validationAttributes = [
        'contenido.*.icono' => 'icono',
        'contenido.*.color' => 'color',
        'contenido.*.url' => 'enlace',
    ];

    protected $messages = [
        'contenido.*.icono.required' => 'El :attribute es requerido.',
        'contenido.*.color.required' => 'El :attribute es requerida.',
        'contenido.*.url.required' => 'El :attribute es requerida.',
    ];

    public function mount($id)
    {
        $this->alianza = Alianza::findOrFail($id);

        if ($this->alianza->redes_sociales) {
            $this->contenido = json_decode($this->alianza->redes_sociales, true);
        } else {
            $this->contenido = [
                [
                    'id' => 1,
                    'icono' => '<i class="fab fa-facebook"></i>',
                    'color' => '#1778f2',
                    'url' => '',
                ],
                [
                    'id' => 2,
                    'icono' => '<i class="fa-brands fa-instagram"></i>',
                    'color' => '#cb0088',
                    'url' => '',
                ],
                [
                    'id' => 3,
                    'icono' => '<i class="fa-brands fa-tiktok"></i>',
                    'color' => '#000000',
                    'url' => '',
                ],
                [
                    'id' => 4,
                    'icono' => '<i class="fa-brands fa-x-twitter"></i>',
                    'color' => '#000000',
                    'url' => '',
                ],
                [
                    'id' => 5,
                    'icono' => '<i class="fa-brands fa-youtube"></i>',
                    'color' => '#ff0000',
                    'url' => '',
                ],
                [
                    'id' => 6,
                    'icono' => '<i class="fa-brands fa-kickstarter-k"></i>',
                    'color' => '#1dde13',
                    'url' => '',
                ],
                [
                    'id' => 7,
                    'icono' => '<i class="fa-brands fa-linkedin"></i>',
                    'color' => '#0a66c3',
                    'url' => '',
                ],
                [
                    'id' => 8,
                    'icono' => '<i class="fa-brands fa-chrome"></i>',
                    'color' => '#fbbe0a',
                    'url' => '',
                ],
            ];
        }
    }

    #[On('handleAlianzaSocialOn')]
    public function handleAlianzaSocialOn($item, $position)
    {
        $index = array_search($item, array_column($this->contenido, 'id'));

        if ($index !== false) {
            $element = array_splice($this->contenido, $index, 1)[0];
            array_splice($this->contenido, $position, 0, [$element]);
        }
    }

    public function guardarAlianzaSocial()
    {
        $this->validate();

        $contenidoJson = json_encode($this->contenido);

        $this->alianza->update([
            'redes_sociales' => $contenidoJson,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    public function render()
    {
        return view('livewire.admin.alianza.alianza-social-livewire');
    }
}
