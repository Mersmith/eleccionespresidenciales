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
            Schema::create('resultado_encuestas', function (Blueprint $table) {
                $table->id();
                
                $table->foreignId('encuesta_id')->constrained()->onDelete('cascade'); // Encuesta relacionada
                $table->foreignId('candidato_cargo_id')->constrained('candidato_cargo')->onDelete('cascade'); // Candidato
                $table->unsignedBigInteger('total_votos')->default(0); // Conteo de votos
                $table->boolean('cerrada')->default(false);

                $table->timestamps();

                $table->unique(['encuesta_id', 'candidato_cargo_id']); // Un registro por candidato en cada encuesta
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado_encuestas');
    }
};
