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
        Schema::create('paiement_tranches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paiement_inscription_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->decimal('montant_tranche', 15, 2);
            $table->string('transaction_id')->unique();
            $table->enum('status', ['pending','approved','failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_tranches');
    }
};
