<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('members_directories');
        

        Schema::create('members_directories', function (Blueprint $table) {
            // $table->dropForeign('assembly_tenures_id');
            $table->id();
            $table->foreignId('assembly_tenures_id')->constrained('assembly_tenures')->onDelete('cascade');
            $table->string('name');
            $table->string('image');
            $table->string('fatherhusbandname');
            $table->string('birthday');
            $table->string('placeofbirth');
            $table->string('maritalstatus');
            $table->string('children');
            $table->integer('wooment');
            $table->string('religion');
            $table->integer('age');
            $table->string('agriculturist')->default('-');
            // POLITICAL INFO
            $table->string('seattype');
            $table->integer('seats');
            $table->string('constituency');
            $table->string('District');
            $table->string('partyassociation');

            // CONTACT IFNO
            $table->string('phonenumber');
            $table->string('email');
            $table->string('webaddress');
            $table->string('presentaddress');
            $table->string('permanentaddress');
            
            // Education
            $table->string('qualification');
            $table->string('yearofpassing');
            $table->string('iu');
            $table->string('edudetails');
            
            
            

            // Previous Official Positions
            $table->string('previousposition'); // before added
            $table->string('govtbody')->default('-');


            // Political Career
            $table->string('party')->default('-'); // before added
            $table->string('pc_detail')->default('-');
            $table->string('pc_fromdate')->default('-');
            $table->string('pc_todate')->default('-');

            // Visits to Countries
            $table->string('vtc_counttry')->default('-');
            $table->string('vtc_purpose')->default('-');
            $table->string('vtc_duration')->default('-');

            //Participation in Events
            $table->string('pie_type')->default('-');
            $table->string('vtc_country')->default('-');
            $table->string('vtc_participatedas')->default('-');
            $table->string('vtc_eventdate')->default('-');

            // Relatives in Assemblies
            $table->string('ria_parliamentarybody')->default('-');
            $table->string('ria_familyrelation')->default('-');
            $table->string('ria_name')->default('-');
            $table->string('ria_duration')->default('-');

            // Member of Committees
            $table->string('moc_position')->default('-');
            $table->string('moc_committee')->default('-');
            $table->string('moc_fromdate')->default('-');
            $table->string('moc_todate')->default('-');
            
            $table->string('moc_fromdate1')->default('-');
            $table->string('moc_todate1')->default('-');
            $table->string('mian_aothdate')->default('-');
            $table->string('memberfromdate')->default('-');
            $table->string('membertodate')->default('-');

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
        
        Schema::dropIfExists('members_directories');
    }
}
