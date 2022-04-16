<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandingCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        // Schema::dropIfExists('standing_committees');
        Schema::create('standing_committees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standing_committees_categories_id')->constrained('standing_committees_categories')->onDelete('cascade');
            $table->string('tab_type');
            $table->string('title');
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
        Schema::dropIfExists('standing_committees');
    }
}
