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
        Schema::create('eleccions', function (Blueprint $table) {
            $table->id();

            $table->string('nombre'); // Presidencial 2026, Municipal 2026, etc.
            $table->enum('tipo', ['presidencial', 'municipal']);
            $table->date('fecha');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleccions');
    }
};
