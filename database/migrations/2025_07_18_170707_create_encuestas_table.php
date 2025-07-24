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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->string('imagen_url')->nullable();

            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('nivel_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('cargo_id')->constrained()->onDelete('cascade');
            $table->foreignId('eleccion_id')->nullable()->constrained()->onDelete('set null');

            $table->foreignId('pais_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('distrito_id')->nullable()->constrained()->onDelete('set null');

            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');

            $table->enum('estado', ['pendiente', 'iniciada', 'finalizada'])->default('pendiente');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
