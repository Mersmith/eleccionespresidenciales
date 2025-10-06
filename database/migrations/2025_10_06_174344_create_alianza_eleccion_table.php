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
        Schema::create('alianza_eleccion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('eleccion_id')->constrained('eleccions')->onDelete('cascade');
            $table->foreignId('alianza_id')->constrained('alianzas')->onDelete('cascade');
            $table->string('numero_en_papeleta')->nullable();
            $table->boolean('activo')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alianza_eleccion');
    }
};
