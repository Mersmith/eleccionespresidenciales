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
        Schema::create('eleccions', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->foreignId('tipo_eleccion_id')->constrained('tipo_eleccions')->onDelete('restrict');
            $table->string('imagen_ruta')->nullable();
            $table->date('fecha_votacion');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleccions');
    }
};
