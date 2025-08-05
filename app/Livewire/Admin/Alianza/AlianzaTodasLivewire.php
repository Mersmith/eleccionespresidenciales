<?php

namespace App\Livewire\Admin\Alianza;

use App\Models\Alianza;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class AlianzaTodasLivewire extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $alianzas = Alianza::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            //dd($alianzas);

        return view('livewire.admin.alianza.alianza-todas-livewire', compact('alianzas'));
    }
}
