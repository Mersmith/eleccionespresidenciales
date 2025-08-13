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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('url_imagen');
            $table->string('link')->nullable();

            // Relaciones opcionales
            $table->foreignId('auspiciador_id')->nullable()->constrained('auspiciadors')->nullOnDelete();
            $table->foreignId('candidato_id')->nullable()->constrained('candidatos')->nullOnDelete();
            $table->foreignId('partido_id')->nullable()->constrained('partidos')->nullOnDelete();
            $table->foreignId('alianza_id')->nullable()->constrained('alianzas')->nullOnDelete();

            // Campo para definir en qué página o sección aparece el anuncio
            // Por ejemplo: 'inicio', 'candidato', 'partido', 'encuesta', 'general', etc.
            $table->enum('pagina', ['inicio', 'candidato', 'partido', 'alianza', 'encuesta', 'resultado'])->nullable()->comment('Página o sección donde se muestra el anuncio');

            $table->dateTime('fecha_inicio')->nullable()->comment('Fecha desde cuando el anuncio estará activo');
            $table->dateTime('fecha_fin')->nullable()->comment('Fecha hasta cuando el anuncio estará activo');

            $table->boolean('activo')->default(true)->comment('1: activo, 0: inactivo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
