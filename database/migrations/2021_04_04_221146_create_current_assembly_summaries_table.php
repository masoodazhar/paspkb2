<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentAssemblySummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('current_assembly_summaries');
        Schema::create('current_assembly_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_id')->constrained('assemblies')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->foreignId('parliamentary_years_id')->constrained('parliamentary_years')->onDelete('cascade');
            $table->foreignId('main_sessions_id')->constrained('main_sessions')->onDelete('cascade');
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->string('summonedby');
            $table->string('fromdate');	
            $table->string('todate');
            $table->string('actualsittings');
            $table->string('totalsittings');
            $table->string('sessiondays');
            $table->longText('description')->default('Optional');
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
        Schema::dropIfExists('current_assembly_summaries');
    }
}
