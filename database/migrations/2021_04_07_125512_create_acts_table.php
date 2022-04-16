<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->foreignId('parliamentary_years_id')->constrained('parliamentary_years')->onDelete('cascade');
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('order_of_the_day_summary_of_proceedings_id')->constrained('order_of_the_day_summary_of_proceedings')->onDelete('cascade');
            $table->string('actno');
            $table->string('title');
            $table->date('dateofpassing');
            $table->date('dateofgov');
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
        Schema::dropIfExists('acts');
    }
}
