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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->integer('semaine');
            $table->integer('salaire');
            $table->integer('eau');
            $table->integer('eletricite');
            $table->integer('communication');
            $table->integer('carburant');
            $table->integer('deplacement');
            $table->integer('sante');
            $table->integer('entretien');
            $table->integer('fourniture');
            $table->integer('amotisement');
            $table->integer('le_20');
            $table->integer('le_10');
            $table->integer('loyer');
            $table->integer('fas');
            $table->integer('fospa');
            $table->integer('dnam');
            $table->integer('autre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
