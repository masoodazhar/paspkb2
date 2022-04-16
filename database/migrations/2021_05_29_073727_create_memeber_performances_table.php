<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemeberPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memeber_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            
            $table->string('assemblyquestiontext');
            $table->string('assemblyquestionvalue');
            
            $table->string('privilegemotionstext');
            $table->string('privilegemotionsvalue');

            $table->string('adjournmentmotiontext');
            $table->string('adjournmentmotionvalue');

            $table->string('privatebillstext');
            $table->string('privatebillsvalue');

            $table->string('Resolutionstext');
            $table->string('Resolutionsvalue');

            $table->string('motionstext');
            $table->string('motionsvalue');

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
        Schema::dropIfExists('memeber_performances');
    }
}
