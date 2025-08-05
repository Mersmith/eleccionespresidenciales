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
        Schema::create('candidato_encuesta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidato_cargo_id')->constrained('candidato_cargo')->onDelete('cascade');
            $table->foreignId('encuesta_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            $table->unique(['candidato_cargo_id', 'encuesta_id'], 'unique_candidato_encuesta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato_encuesta');
    }
};
