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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('titulo'); 
            $table->string('slug')->unique();
            $table->string('image')->nullable(); 
            $table->text('content');
        
            // SEO opcional
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
        
            // Relaciones opcionales
            $table->foreignId('candidato_id')->nullable()->constrained('candidatos')->nullOnDelete();
            $table->foreignId('partido_id')->nullable()->constrained('partidos')->nullOnDelete();
            $table->foreignId('alianza_id')->nullable()->constrained('alianzas')->nullOnDelete();
        
            // Otras
            $table->unsignedBigInteger('views')->default(0);
            $table->integer('orden')->nullable();
            $table->boolean('activo')->default(true)->comment('1: activo, 0: inactivo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
