<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOfTheDaySummaryOfProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_of_the_day_summary_of_proceedings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->date('sittingsdate');
            $table->string('sittingsno')->default('0');
            $table->string('referencenumber')->default('0');
            $table->string('sittingstype');
            $table->string('type');
            $table->longText('description');
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
        Schema::dropIfExists('order_of_the_day_summary_of_proceedings');
    }
}
