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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->string('foto')->nullable();
            $table->json('redes_sociales')->nullable();

            $table->foreignId('partido_id')->nullable()->constrained()->onDelete('set null');

            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('distrito_id')->nullable()->constrained()->onDelete('set null');

            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
