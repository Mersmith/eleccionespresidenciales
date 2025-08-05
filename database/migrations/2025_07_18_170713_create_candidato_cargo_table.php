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
        Schema::create('candidato_cargo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('nivel_id')->nullable()->constrained('nivels')->onDelete('set null');
            $table->foreignId('candidato_id')->constrained('candidatos')->onDelete('cascade');
            $table->foreignId('cargo_id')->constrained('cargos')->onDelete('cascade');
            $table->foreignId('eleccion_id')->constrained('eleccions')->onDelete('cascade');
            $table->foreignId('partido_id')->nullable()->constrained('partidos')->onDelete('set null');
            $table->foreignId('alianza_id')->nullable()->constrained('alianzas')->onDelete('set null');
            $table->string('numero')->nullable()->comment('Número de votación para ciertos cargos');

            $table->foreignId('pais_id')->nullable()->constrained('pais')->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained('provincias')->onDelete('set null');
            $table->foreignId('distrito_id')->nullable()->constrained('distritos')->onDelete('set null');

            $table->boolean('principal')->default(false)->comment('1 SI, 0 NO');
            $table->boolean('electo')->default(false)->comment('1 ELEGIDO, 0 TODAVIDA');

            $table->timestamps();

            $table->unique(['candidato_id', 'cargo_id', 'eleccion_id', 'pais_id', 'region_id', 'provincia_id', 'distrito_id'], 'unique_postulacion');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato_cargo');
    }
};
