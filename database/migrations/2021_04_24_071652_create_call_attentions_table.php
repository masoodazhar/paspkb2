<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallAttentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_attentions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sessions_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('members_directories_id')->constrained('members_directories')->onDelete('cascade');
            $table->foreignId('parliamentary_years_id')->constrained('parliamentary_years')->onDelete('cascade');
            $table->string('number');
            $table->string('date');
            $table->string('subject');
            $table->string('department');
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
        Schema::dropIfExists('call_attentions');
    }
}
