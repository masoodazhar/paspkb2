<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Standingcommitteesmember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // Schema::dropIfExists('public_accounts_committees');
         Schema::create('standingcommitteesmember', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acc_id')->constrained('standing_committees_categories')->onDelete('cascade');
            $table->json('members_directories_id');
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
        Schema::dropIfExists('standingcommitteesmember');
    }
}
