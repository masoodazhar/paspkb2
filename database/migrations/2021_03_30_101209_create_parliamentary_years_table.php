<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParliamentaryYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('parliamentary_years');
        Schema::create('parliamentary_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_id')->constrained('assemblies')->onDelete('cascade');
            $table->foreignId('assemblytenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string("name");

            $table->string("pyfromdate");
            $table->string("pytodate");

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
        Schema::dropIfExists('parliamentary_years');
    }
}
