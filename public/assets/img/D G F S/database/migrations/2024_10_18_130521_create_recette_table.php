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
        Schema::create('recette', function (Blueprint $table) {
            $table->id();
            $table->integer('vente_ouvrage');
            $table->integer('dime');
            $table->integer('offrande');
            $table->integer('dons');
            $table->integer('sbvention');
            $table->integer('offrande_special');
            $table->integer('legs');
            $table->integer('autre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette');
    }
};
