<?php

namespace Database\Seeders;

use App\Models\Partido;
use Illuminate\Database\Seeder;

class PartidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partidos = [
            'Acción Popular',
            'Ahora Nación',
            'Alianza para el Progreso (APP)',
            'Avanza País Partido de Integración Social',
            'Batalla Perú',
            'Fe en el Perú',
            'Frente Popular Agrícola FIA del Perú',
            'Fuerza Popular',
            'Juntos por el Perú',
            'Libertad Popular',
            'Nuevo Perú por el Buen Vivir',
            'Partido Aprista Peruano',
            'Partido Ciudadanos por el Perú',
            'Partido Cívico Obras',
            'Partido de los Trabajadores y Emprendedores (PTE Perú)',
            'Partido del Buen Gobierno',
            'Partido Demócrata Unido Perú',
            'Partido Demócrata Verde',
            'Partido Democrático Federal',
            'Partido Democrático Somos Perú',
            'Partido Frente de la Esperanza 2021',
            'Partido Morado',
            'Partido País para Todos',
            'Partido Patriótico del Perú',
            'Partido Político Cooperación Popular',
            'Partido Político Fuerza Moderna',
            'Partido Político Integridad Democrática',
            'Partido Político Nacional Perú Libre',
            'Partido Político Perú Acción',
            'Partido Político Perú Primero',
            'Partido Político Peruanos Unidos - Somos Libres',
            'Partido Político Popular Voces del Pueblo',
            'Partido Político Prin',
            'Partido Popular Cristiano (PPC)',
            'Partido Político Sí Creo',
            'Partido Unidad y Paz',
            'Perú Moderno',
            'Podemos Perú',
            'Primero la Gente Comunidad Ecología Libertad y Progreso',
            'Progresemos',
            'Renovación Popular',
            'Salvemos al Perú',
            'Un Camino Diferente',
        ];

        foreach ($partidos as $nombre) {
            Partido::create([
                'nombre' => $nombre,
                'sigla' => null,
                'logo' => 'https://example.com/logos/' . '.png',
            ]);
        }
    }
}
