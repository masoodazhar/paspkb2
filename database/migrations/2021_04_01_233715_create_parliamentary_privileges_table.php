<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParliamentaryPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliamentary_privileges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('actno');
            $table->string('dateofpassing');
            $table->string('dateofgovernersassent');
            $table->string('status');
            $table->longText('description');
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
        Schema::dropIfExists('parliamentary_privileges');
    }
}
