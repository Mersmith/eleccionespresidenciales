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
        Schema::create('votos_historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // Usuario que votó
            $table->foreignId('encuesta_id'); // Encuesta cerrada
            $table->foreignId('candidato_cargo_id'); // Candidato elegido
            $table->dateTime('fecha_voto'); // Fecha y hora del voto
            $table->timestamps(); // Fecha de archivado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos_historial');
    }
};
