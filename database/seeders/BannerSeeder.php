<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'nombre' => 'Banner 1',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-1-computadora-1.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-1-movil-1.jpg',
                'link' => 'https://example.com/link1',
                'activo' => true,
            ],
            [
                'nombre' => 'Banner 2',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-2-computadora-1.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-2-movil-1.jpg',
                'link' => 'https://example.com/link2',
                'activo' => true,
            ],
            [
                'nombre' => 'Banner 3',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-computadora-1.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-movil-1.jpg',
                'link' => 'https://example.com/link3',
                'activo' => true,
            ],
            [
                'nombre' => 'Banner 4',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-computadora-2.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-movil-2.jpg',
                'link' => 'https://example.com/link4',
                'activo' => true,
            ],
            [
                'nombre' => 'Banner 5',
                'imagen_computadora' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-computadora-3.jpg',
                'imagen_movil' => 'http://127.0.0.1:8000/assets/images/banner/banner-tipo-3-movil-3.jpg',
                'link' => 'https://example.com/link5',
                'activo' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
