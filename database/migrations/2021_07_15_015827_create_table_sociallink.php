<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSociallink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->default('https://www.facebook.com');
            $table->string('youtube')->default('https://www.youtube.com');
            $table->string('twitter')->default('https://www.twitter.com');
            $table->string('linkedin')->default('https://www.linkedin.com');
            $table->string('google')->default('https://www.google.com');
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
        Schema::dropIfExists('social_links');
    }
}
