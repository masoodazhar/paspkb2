<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('bills');
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_id')->constrained('assemblies')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('title');
            $table->string('bill_type');
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->string('status');
            $table->date('date');
            $table->string('type_tabs');
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
        Schema::dropIfExists('bills');
    }
}
