<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicAccountsCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('public_accounts_committees');
        Schema::create('public_accounts_committees', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('tab_type');
            $table->string('page');
            $table->string('type');
            $table->date('date'); 
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
        Schema::dropIfExists('public_accounts_committees');
    }
}
