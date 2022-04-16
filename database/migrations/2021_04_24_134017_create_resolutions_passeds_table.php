<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolutionsPassedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('resolutions_passeds');
        Schema::create('resolutions_passeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('number');
            $table->string('title');
            $table->string('restype');
            $table->string('date');
            $table->string('status');
            $table->string('department');
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
        Schema::dropIfExists('resolutions_passeds');
    }
}
