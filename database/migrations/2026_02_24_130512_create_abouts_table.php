<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable(); // Exemple: About Us
            $table->string('title'); // Exemple: We Help Our Clients To Grow Their Business
            $table->text('description')->nullable(); // Texte principal
            $table->string('image_path')->nullable(); // Image d’illustration
            $table->json('tabs')->nullable(); // Story / Mission / Vision
            $table->json('features')->nullable(); // Les 3 boxes (No Hidden Cost, Dedicated Team, 24/7)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
