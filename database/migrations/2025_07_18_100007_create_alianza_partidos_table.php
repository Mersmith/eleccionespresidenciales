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
        Schema::create('alianza_partidos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alianza_id');
            $table->unsignedBigInteger('partido_id');

            $table->foreign('alianza_id')->references('id')->on('alianzas')->onDelete('cascade');
            $table->foreign('partido_id')->references('id')->on('partidos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alianza_partidos');
    }
};
