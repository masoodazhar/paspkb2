<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyTenuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('assembly_tenures');
        Schema::create('assembly_tenures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_id')->constrained('assemblies')->onUpdate('cascade');
            $table->string("fromdate");
            $table->string("todate");
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
        Schema::dropIfExists('assembly_tenures');
    }
}
