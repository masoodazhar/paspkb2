<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesindhtrans2016sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesindhtrans2016smain', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('actno');
            $table->string('passedon');
            $table->string('dateofenforcement');
            $table->timestamps();
        });

        Schema::create('thesindhtrans2016s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->text('image_pdf_link')->default('No Data');
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
        Schema::dropIfExists('thesindhtrans2016smain');
        Schema::dropIfExists('thesindhtrans2016s');
    }
}
