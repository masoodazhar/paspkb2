<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinetCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('cabinet_compositions');
        Schema::create('cabinet_compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('category');
            $table->string('tabs');
            // $table->boolean('leaderofthehouse');
            // $table->boolean('leaderofopposition');
            $table->longText('description');
            $table->string('cfromdate');
            $table->string('ctodate');
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
        Schema::dropIfExists('cabinet_compositions');
    }
}
