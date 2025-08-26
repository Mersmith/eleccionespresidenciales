<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alianzas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('sigla')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('logo')->nullable();
            $table->string('plan_gobierno')->nullable();
            $table->json('redes_sociales')->nullable();
            $table->string('color')->nullable()->default('#3498db');
            $table->foreignId('eleccion_id')->constrained()->onDelete('cascade');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alianzas');
    }
};
