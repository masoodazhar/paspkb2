<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('members_directories_name_id')->constrained('members_directories')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('elfromdate');
            $table->string('eltodate');
            $table->string('reasion');
            $table->foreignId('members_directories_current_id')->constrained('members_directories')->onDelete('cascade');
            $table->string('aothdate');
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
        Schema::dropIfExists('elections');
    }
}
