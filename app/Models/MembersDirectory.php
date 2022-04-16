<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersDirectory extends Model
{
    protected $table = 'members_directories';
    protected $fillable=[
        'assembly_tenures_id',
        'name',
        'image',
        'fatherhusbandname',
        'birthday',
        'placeofbirth',
        'maritalstatus',
        'children',
        'wooment',
        'religion',
        'age',
        'agriculturist',
        'seattype',
        'seats',
        'constituency',
        'District',
        'partyassociation',
        'phonenumber',
        'email',
        'webaddress',
        'presentaddress',
        'permanentaddress',
        'qualification',
        'yearofpassing',
        'iu',
        'edudetails',
        'previousposition',
        'govtbody',
        'party',
        'pc_detail',
        'pc_fromdate',
        'pc_todate',
        'vtc_counttry',
        'vtc_purpose',
        'vtc_duration',
        'pie_type',
        'vtc_country',
        'vtc_participatedas',

        'vtc_eventdate',
        'ria_parliamentarybody',
        'ria_familyrelation',
        'ria_name',
        'ria_duration'

    ];
}
