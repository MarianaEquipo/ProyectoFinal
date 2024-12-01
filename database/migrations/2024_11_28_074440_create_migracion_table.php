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
        Schema::create('migracion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo',50);
            $table->string('autor',50);
            $table->string('genero',50);
            $table->string('sinopsis',300);
            $table->float('duracion',4,2);
            $table->string('portada');
            $table->string('gusto');
            $table->string('fecha');
            $table->string('video');
            $table->string('tipo');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migracion');
    }
};
