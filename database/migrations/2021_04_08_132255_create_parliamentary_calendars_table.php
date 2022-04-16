<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParliamentaryCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliamentary_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assemblies_id')->constrained('assemblies')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->foreignId('parliamentary_years_id')->constrained('parliamentary_years')->onDelete('cascade');
            $table->date('fromdate');
            $table->string('type');
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
        Schema::dropIfExists('parliamentary_calendars');
    }
}
