<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('name')->default('-');
            $table->string('fatherhusbandname')->default('-');
            $table->string('image')->default('-');
            $table->string('birthday')->default('-');
            $table->string('email')->default('-');
            $table->string('presentaddress')->default('-');
            $table->string('permanentaddress')->default('-');
            $table->string('phonenumber')->default('-');            
            $table->string('constituency')->default('-');
            $table->string('district')->default('-');
            $table->string('partyassociation')->default('-');
            $table->string('category')->default('-');
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
        Schema::dropIfExists('advisors');
    }
}
