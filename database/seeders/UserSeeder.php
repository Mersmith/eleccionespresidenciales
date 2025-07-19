<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 administradores
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'), // puedes cambiar la contraseña
                'role' => 'admin',
            ]);
        }

        User::factory()->count(50)->create();

        // User::factory(10)->create();

        /*User::factory()->create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    ]);*/
    }
}
