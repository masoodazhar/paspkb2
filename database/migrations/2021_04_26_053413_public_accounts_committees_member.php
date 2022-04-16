<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PublicAccountsCommitteesMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('public_accounts_committees');
        Schema::create('public_accounts_committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('page')->default('no');
            $table->json('members_directories_id'); 
            $table->foreignId('member_chairman')->constrained('members_directories')->onDelete('cascade');
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
        Schema::dropIfExists('public_accounts_committee_members');
    }
}
