<?php

namespace App\Livewire\Admin\Post;

use App\Models\Alianza;
use App\Models\Candidato;
use App\Models\Partido;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class PostCrearLivewire extends Component
{
    public $candidatos = [], $partidos = [], $alianzas = [];
    public $candidato_id;
    public $partido_id;
    public $alianza_id;

    public $titulo;
    public $slug;
    public $image;
    public $content;
    public $meta_title;
    public $meta_description;
    public $activo = 0;

    protected function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug',
            'image' => 'required|string|max:255',
            'candidato_id' => 'nullable|exists:candidatos,id',
            'partido_id' => 'nullable|exists:partidos,id',
            'alianza_id' => 'nullable|exists:alianzas,id',
            'content' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ];
    }

    public function mount()
    {
        $this->candidatos = Candidato::all();
        $this->partidos = Partido::all();
        $this->alianzas = Alianza::where('activo', true)->get();
    }

    public function updatedTitulo($value)
    {
        $this->slug = Str::slug($value);
    }

    public function crearPost()
    {
        $this->validate();

        $seleccionados = collect([
            $this->candidato_id,
            $this->partido_id,
            $this->alianza_id,
        ])->filter(fn($v) => !is_null($v) && $v !== '')->count();

        if ($seleccionados !== 1) {
            $this->addError('relacionados', 'Debe seleccionar exactamente uno entre candidato, partido o alianza.');
            return;
        }

        Post::create([
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'image' => $this->image,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'candidato_id' => $this->candidato_id,
            'partido_id' => $this->partido_id,
            'alianza_id' => $this->alianza_id,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.post.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.post.post-crear-livewire');
    }
}
