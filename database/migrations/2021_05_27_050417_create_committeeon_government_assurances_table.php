<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeonGovernmentAssurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committeeon_government_assurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->foreignId('assembly_id')->constrained('assemblies')->onUpdate('cascade');
            $table->json('members_directories_ids');
            $table->string('committeformationdate');
            $table->string('committeedissolutiondate');
            $table->string('Purpose');
            $table->string('name');
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
        Schema::dropIfExists('committeeon_government_assurances');
    }
}
