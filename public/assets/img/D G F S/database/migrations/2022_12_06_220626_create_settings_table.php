<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name' ,255)->nullable();
            $table->string('website_url' ,255)->nullable();
            $table->string('title' ,255)->nullable();
            $table->string('meta_keywords' , 500)->nullable();
            $table->string('meta_description' , 500)->nullable();

            $table->string('address' , 500)->nullable();
            $table->string('phone1' ,255)->nullable();
            $table->string('phone2' ,255)->nullable();
            $table->string('email1' ,255)->nullable();
            $table->string('email2' ,255)->nullable();

            $table->string('facebook' ,255)->nullable();
            $table->string('twitter' ,255)->nullable();
            $table->string('instagram' ,255)->nullable();
            $table->string('youtube' ,255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
