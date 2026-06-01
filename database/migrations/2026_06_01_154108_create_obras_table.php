<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('tecnica');
            $table->integer('anio');
            $table->decimal('precio', 10, 2);
            $table->string('imagen')->nullable(); // Guardará el nombre del archivo de imagen
            $table->foreignId('artista_id')->constrained('artistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('obras');
    }
};
