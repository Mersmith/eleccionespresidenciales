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
        // Plan Gratis
        Plan::updateOrCreate(
            ['nombre' => 'Gratis'],
            [
                'requiere_pago' => false,
                'precio' => 0.00,
                'descripcion' => "Plan gratuito para candidatos reconocidos. Incluye: participación básica en encuestas, descripción breve, enlaces a redes sociales.",
            ]
        );

        // Plan Básico - S/100 / mes
        Plan::updateOrCreate(
            ['nombre' => 'Básico'],
            [
                'requiere_pago' => true,
                'precio' => 100.00,
                'descripcion' => "Plan Básico (S/100/mes). Beneficios: participación en encuestas, descripción ampliada, gestión de redes sociales, soporte básico. Ideal para candidatos que empiezan.",
            ]
        );

        // Plan Pro - S/200 / mes
        Plan::updateOrCreate(
            ['nombre' => 'Pro'],
            [
                'requiere_pago' => true,
                'precio' => 200.00,
                'descripcion' => "Plan Pro (S/200/mes). Beneficios: todo lo del Básico + video de presentación, sección para plan de gobierno, prioridad en listados y opción de integrar equipo de elecciones (colaboradores). Recomendado para campañas que buscan mayor visibilidad.",
            ]
        );
    }
}
