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
            ['nombre' => 'Gratis candidato'],
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
                'descripcion' => "Plan gratuito para candidatos reconocidos. Incluye: participación básica en encuestas, descripción breve, enlaces a redes sociales.",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Slider inicio'],
            [
                'requiere_pago' => true,
                'precio' => 200.00,
                'descripcion' => "Plan Básico (S/100/mes). Beneficios: participación en encuestas, descripción ampliada, gestión de redes sociales, soporte básico. Ideal para candidatos que empiezan.",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Banner cuerpo'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Plan Pro (S/200/mes). Beneficios: todo lo del Básico + video de presentación, sección para plan de gobierno, prioridad en listados y opción de integrar equipo de elecciones (colaboradores). Recomendado para campañas que buscan mayor visibilidad.",
            ]
        );

        Plan::updateOrCreate(
            ['nombre' => 'Publicidad encuesta'],
            [
                'requiere_pago' => true,
                'precio' => 500.00,
                'descripcion' => "Plan Pro (S/200/mes). Beneficios: todo lo del Básico + video de presentación, sección para plan de gobierno, prioridad en listados y opción de integrar equipo de elecciones (colaboradores). Recomendado para campañas que buscan mayor visibilidad.",
            ]
        );
    }
}
