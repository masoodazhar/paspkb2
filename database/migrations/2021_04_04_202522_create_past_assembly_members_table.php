<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastAssemblyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_assembly_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assemblytenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('name');
            $table->string('fromdate');
            $table->string('todate');
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
        Schema::dropIfExists('past_assembly_members');
    }
}
