<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiement_inscriptions', function (Blueprint $table) {

            $table->id();

            // ================= INFOS PERSONNELLES =================
            $table->string('nom');
            $table->string('prenoms');
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();

            // ================= OPTION =================
            $table->foreignId('option_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // ================= LOCALISATION (Maternelle / Primaire) =================
            $table->foreignId('departement_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('circonscription_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('district_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('formation_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // ================= ENSEIGNEMENT =================
            $table->foreignId('enseignement_id')
                  ->constrained('enseignements')
                  ->cascadeOnDelete();

            $table->string('autre_enseignement')->nullable();

            // ================= LOCALISATION (Secondaire / Autre) =================
            $table->foreignId('province_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('region_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // ================= PAIEMENT =================
            $table->unsignedBigInteger('montant');

            $table->string('status')
                  ->default('pending')
                  ->comment('pending, approved, failed');

            $table->boolean('recu_envoye')
                  ->default(false)
                  ->comment('Indique si le reçu a été envoyé par email');

            $table->string('reference')->unique();
            $table->string('transaction_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->longText('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiement_inscriptions');
    }
};
