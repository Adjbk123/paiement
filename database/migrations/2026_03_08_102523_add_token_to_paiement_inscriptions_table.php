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
        Schema::table('paiement_inscriptions', function (Blueprint $table) {
            // Code unique de suivi pour le paiement flexible (ex: MAF-2025-A3F7K)
            $table->string('token', 20)->nullable()->unique()->after('reference');
        });
    }

    public function down(): void
    {
        Schema::table('paiement_inscriptions', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
};
