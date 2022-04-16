<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowersFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('powers_functions_main');
        // Schema::dropIfExists('powers_functions');
        Schema::create('powers_functions_main', function (Blueprint $table) {
            $table->id();
            $table->longText('main_description');
            $table->timestamps();
        });
        Schema::create('powers_functions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('powers_functions_main');
        Schema::dropIfExists('powers_functions');
    }
}
