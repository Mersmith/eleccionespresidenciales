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
        Schema::create('candidato_cargo_equipo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lider_candidato_cargo_id')->constrained('candidato_cargo')->onDelete('cascade');

            $table->foreignId('integrante_candidato_cargo_id')->constrained('candidato_cargo')->onDelete('cascade');

            $table->string('rol')->nullable();

            $table->integer('orden')->nullable();

            $table->timestamps();

            $table->unique(['lider_candidato_cargo_id', 'integrante_candidato_cargo_id'], 'uq_lider_integrante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato_cargo_equipos');
    }
};
