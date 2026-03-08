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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->string('website_name' ,255)->nullable();
            $table->string('website_url' ,255)->nullable();
            
            $table->longText('meta_description' , 500)->nullable();

            $table->string('address' , 500)->nullable();
            $table->string('phone1' ,255)->nullable();
            $table->string('phone2' ,255)->nullable();
            $table->string('email1' ,255)->nullable();
            $table->string('email2' ,255)->nullable();

            $table->string('facebook' ,255)->nullable();
            $table->string('twitter' ,255)->nullable();
            $table->string('whatsapp' ,255)->nullable();
            $table->string('youtube' ,255)->nullable();

            $table->string('photo' ,255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
