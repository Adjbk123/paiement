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
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->integer('semaine');
            $table->integer('dime');
            $table->integer('offrande');
            $table->integer('offrande_m');
            $table->integer('offrande_j');
            $table->integer('offrande_special');
            $table->integer('edl');
            $table->integer('action_grace');
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
        Schema::dropIfExists('recettes');
    }
};
