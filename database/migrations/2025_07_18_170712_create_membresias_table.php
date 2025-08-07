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
        Schema::create('membresias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidato_id')->constrained()->onDelete('cascade');
            $table->date('mes'); // ejemplo: 2025-08-01
            $table->boolean('pagado')->default(false);
            $table->foreignId('plan_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('precio_pagado', 8, 2); // precio real del momento

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membresias');
    }
};
