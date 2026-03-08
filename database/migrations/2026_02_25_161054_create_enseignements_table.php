<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enseignements', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // Maternel, Primaire, Secondaire, Autre
            $table->enum('statut', ['visible', 'invisible'])->default('visible');
            $table->timestamps();
        });

        // Optionnel : insérer les valeurs de base
        DB::table('enseignements')->insert([
            ['nom' => 'Maternel', 'statut' => 'visible', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Primaire', 'statut' => 'visible', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Secondaire', 'statut' => 'visible', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Autre', 'statut' => 'visible', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignements');
    }
};
