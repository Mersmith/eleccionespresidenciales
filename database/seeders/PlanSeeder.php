<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*CANDIDATO */
        // Plan Gratis
        Plan::updateOrCreate(
            ['nombre' => 'Prueba candidato'],
            [
                'requiere_pago' => false,
                'precio' => 0.00,
                'descripcion' => "Plan gratuito para candidatos reconocidos. Incluye: participación básica en encuestas, descripción breve, enlaces a redes sociales.",
            ]
        );

        // Plan Básico - S/100 / mes
        Plan::updateOrCreate(
            ['nombre' => 'Básico candidato'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Plan Básico (S/100/mes). Beneficios: participación en encuestas, descripción ampliada, gestión de redes sociales, soporte básico. Ideal para candidatos que empiezan.",
            ]
        );

        // Plan Pro - S/200 / mes
        Plan::updateOrCreate(
            ['nombre' => 'Pro candidato'],
            [
                'requiere_pago' => true,
                'precio' => 200.00,
                'descripcion' => "Plan Pro (S/200/mes). Beneficios: todo lo del Básico + video de presentación, sección para plan de gobierno, prioridad en listados y opción de integrar equipo de elecciones (colaboradores). Recomendado para campañas que buscan mayor visibilidad.",
            ]
        );

        /*AUSPICIADOR */
        Plan::updateOrCreate(
            ['nombre' => 'Banner inicio'],
            [
                'requiere_pago' => true,
                'precio' => 200.00,
                'descripcion' => "Publicidad en la página de inicio",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Banner inicio intermedio'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Publicidad en la página de inicio intermedio",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Banner inicio final'],
            [
                'requiere_pago' => true,
                'precio' => 50.00,
                'descripcion' => "Publicidad en la página de inicio final",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Slider inicio'],
            [
                'requiere_pago' => true,
                'precio' => 200.00,
                'descripcion' => "Publicidad en la página de inicio slider",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Banner encuesta'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Publicidad en la página de encuesta",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Banner resultado'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Publicidad en la página de resultado",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Anuncio propio'],
            [
                'requiere_pago' => true,
                'precio' => 300.00,
                'descripcion' => "Publicidad propio de candidato, partido o alianza",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Publicidad encuesta'],
            [
                'requiere_pago' => true,
                'precio' => 400.00,
                'descripcion' => "Publicidad en la página encuesta",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Publicidad resultado'],
            [
                'requiere_pago' => true,
                'precio' => 400.00,
                'descripcion' => "Publicidad en la página resultado",
            ]
        );
    }
}
