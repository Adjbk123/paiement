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
        Schema::table('options', function (Blueprint $table) {
            // Montant minimum du premier versement (null = pas de minimum, tout montant accepté)
            $table->decimal('montant_minimum', 10, 2)->nullable()->after('option_montant');
        });
    }

    public function down(): void
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('montant_minimum');
        });
    }
};
