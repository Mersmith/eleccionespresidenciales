<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class BannerTodasLivewire extends Component
{
    public function render()
    {
        $banners = Banner::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.banner.banner-todas-livewire', [
            'banners' => $banners,
        ]);
    }
}
