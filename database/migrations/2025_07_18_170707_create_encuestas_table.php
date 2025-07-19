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

            $table->string('titulo');

            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');

            $table->foreignId('cargo_id')->constrained()->onDelete('cascade');

            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('distrito_id')->nullable()->constrained()->onDelete('set null');

            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');

            $table->boolean('activa')->default(true);

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