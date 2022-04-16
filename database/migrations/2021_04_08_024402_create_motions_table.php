<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assemblies_id')->constrained('assemblies')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->foreignId('parliamentary_years_id')->constrained('parliamentary_years')->onDelete('cascade');
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('order_of_the_day_summary_of_proceedings_id')->constrained('order_of_the_day_summary_of_proceedings')->onDelete('cascade');
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->string('status');
            $table->string('motiontype');
            $table->string('motionno');
            $table->string('title');
            $table->string('typetabs');
            $table->string('type');
            $table->longText('image_pdf_link');
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
        Schema::dropIfExists('motions');
    }
}
