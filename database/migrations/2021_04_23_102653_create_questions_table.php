<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->string('number');
            $table->string('date');
            $table->string('subject');
            $table->string('department');
            $table->string('status');
            $table->string('type');
            $table->longText('image_pdf_link')->default('No Data');
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
        Schema::dropIfExists('questions');
    }
}
