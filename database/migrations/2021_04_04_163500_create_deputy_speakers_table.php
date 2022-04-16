<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeputySpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('deputy_speakers');
        Schema::dropIfExists('deputy_speakers_main');

        Schema::create('deputy_speakers_main', function (Blueprint $table) {
            $table->id();
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->foreignId('assembly_id')->constrained('assemblies')->onUpdate('cascade');
            $table->json('members_directories_ids');
            $table->string('designation');
            $table->longText('speakermessage');
            $table->longText('speakersrole');
            $table->timestamps();
        });
        Schema::create('deputy_speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->date('date');
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
        Schema::dropIfExists('deputy_speakers');
    }
}
