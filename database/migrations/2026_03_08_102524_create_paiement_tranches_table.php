<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Ajoute les colonnes manquantes à la table existante
    public function up(): void
    {
        Schema::table('paiement_tranches', function (Blueprint $table) {
            if (!Schema::hasColumn('paiement_tranches', 'reference')) {
                $table->string('reference')->unique()->after('montant_tranche');
            }
            if (!Schema::hasColumn('paiement_tranches', 'payment_url')) {
                $table->string('payment_url')->nullable()->after('transaction_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('paiement_tranches', function (Blueprint $table) {
            $table->dropColumn(['reference', 'payment_url']);
        });
    }
};
