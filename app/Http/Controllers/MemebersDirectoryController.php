<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\MembersDirectory;
use App\Models\AssemblyTenure;
use Illuminate\Support\Facades\Storage;
use App\Models\Party;

class MemebersDirectoryController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:members-performance-report-list|members-performance-report-create|members-performance-report-edit|members-performance-report-delete', ['only' => ['index','store']]);
         $this->middleware('permission:members-performance-report-create', ['only' => ['create','store']]);
         $this->middleware('permission:members-performance-report-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:members-performance-report-delete', ['only' => ['destroy']]);
    }


    public function get_memebersdirectorybyalpha($tenureid, $alpha){
        $allRows = DB::table('members_directories')
        ->where([
                ['name', 'like', $alpha.'%'],
            ]
        )
        ->where('members_directories.assembly_tenures_id', $tenureid)
        ->get();
        // dd($allRows);

        return response()->json($allRows);
    }
    public function advanceSearch(Request $request, $locale='en'){

        $columns = [];
        $values = [];
        foreach ($request->all() as $key => $value) {
            // $key gives you the key. 2 and 7 in your case.
            if($value !== null && $key !== 'age'){
                array_push($columns, $key);
                array_push($values, $value);
            }
          }



        $query = MembersDirectory::query();

        foreach($columns as $index => $column){
            $query->Where($column, 'LIKE', '%' . $values[$index] . '%');
        }

        if($request->age !== null){
            $query->whereBetween('age', explode(',',$request->age));
        }

        $query->where('members_directories.lang', $locale);



        $data = $query->get();


        return response()->json($data);

        /**
         * ------------------------------
         * before implementation
         * --------------------------
         */

        $name = $request->name;
        $qualification = $request->qualification;
        $age = $request->age;
        $religion = $request->religion;
        $previousposition = $request->previouspositions;
        $seattype = $request->seattype;
        $maritalstatus = $request->maritalstatus;
        $constituency = $request->Constituency;
        $presentaddress = $request->Address;

        $dateofbirth = $request->dateofbirth;
        $placeofbirth = $request->placeofbirth;
        $district = $request->district;
        $partyassociation = $request->partyassociation;
        $phonenumber = $request->phonenumber;
        $email = $request->email;


        $allRows = [];

        if($name != '' && $qualification != '' && $age !='' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                        ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                        ['constituency', 'like', '%'.$constituency.'%'],
                        ['presentaddress', 'like', '%'.$presentaddress.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }

        else if($dateofbirth !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['birthday', 'like', '%'.$dateofbirth.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($placeofbirth !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['placeofbirth', 'like', '%'.$placeofbirth.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($district !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['District', 'like', '%'.$district.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($partyassociation !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['partyassociation', 'like', '%'.$partyassociation.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($phonenumber !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['phonenumber', 'like', '%'.$phonenumber.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if($email !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['email', 'like', '%'.$email.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if($qualification != '' && $age !='' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                        ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                        ['constituency', 'like', '%'.$constituency.'%'],
                        ['presentaddress', 'like', '%'.$presentaddress.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
         else if($age !='' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                        ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                        ['constituency', 'like', '%'.$constituency.'%'],
                        ['presentaddress', 'like', '%'.$presentaddress.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['religion', 'like', '%'.$religion.'%'],
                    ['previousposition', 'like', '%'.$previousposition.'%'],
                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if($previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['previousposition', 'like', '%'.$previousposition.'%'],
                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if( $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([

                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if( $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([

                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if($maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }

        else if($constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($name != '' && $qualification != '' && $age !='' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != ''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                        ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                        ['constituency', 'like', '%'.$constituency.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != '' && $age !='' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                        ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != '' && $age !='' && $religion != '' && $previousposition !='' && $seattype !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                        ['seattype', 'like', '%'.$seattype.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != '' && $age !='' && $religion != '' && $previousposition !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                        ['previousposition', 'like', '%'.$previousposition.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != '' && $age !='' && $religion != ''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                        ['religion', 'like', '%'.$religion.'%'],
                    ]
                )
                ->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != '' && $age !=''){
                $allRows = DB::table('members_directories')
                ->whereBetween('age', explode(',',$request->age))
                ->where([
                        ['name', 'like', '%'.$name.'%'],
                        ['qualification', 'like', '%'.$qualification.'%'],
                    ]
                )->where('members_directories.lang', $locale)
                ->get();
        }
        else if($name != '' && $qualification != ''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['name', 'like', '%'.$name.'%'],
                    ['qualification', 'like', '%'.$qualification.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($name != ''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['name', 'like', '%'.$name.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($name != '' && $qualification != '' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['name', 'like', '%'.$name.'%'],
                    ['qualification', 'like', '%'.$qualification.'%'],
                    ['religion', 'like', '%'.$religion.'%'],
                    ['previousposition', 'like', '%'.$previousposition.'%'],
                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($name != '' && $qualification != '' && $religion != '' && $previousposition !='' && $seattype !='' && $maritalstatus !='' && $constituency != '' && $presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['name', 'like', '%'.$name.'%'],
                    ['qualification', 'like', '%'.$qualification.'%'],
                    ['religion', 'like', '%'.$religion.'%'],
                    ['previousposition', 'like', '%'.$previousposition.'%'],
                    ['seattype', 'like', '%'.$seattype.'%'],
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%'],
                    ['constituency', 'like', '%'.$constituency.'%'],
                    ['presentaddress', 'like', '%'.$presentaddress.'%'],
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($age != ''){
            $allRows = DB::table('members_directories')
            ->whereBetween('age', explode(',',$request->age))
            ->where('members_directories.lang', $locale)
            ->get();

        }
        else if($qualification != ''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['qualification', 'like', '%'.$qualification.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($religion != ''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['religion', 'like', '%'.$religion.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if( $previousposition !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['previousposition', 'like', '%'.$previousposition.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($seattype !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['seattype', 'like', '%'.$seattype.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($maritalstatus !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['maritalstatus', 'like', '%'.$maritalstatus.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($constituency !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['constituency', 'like', '%'.$constituency.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        else if($presentaddress !=''){
            $allRows = DB::table('members_directories')
            ->where([
                    ['presentaddress', 'like', '%'.$presentaddress.'%']
                ]
            )
            ->where('members_directories.lang', $locale)
            ->get();
        }
        return $allRows;
    }

    public function get_memebersdirectoryassemblies($tenure=false, $locale='en'){
        $allRows = DB::table('assemblies')->where('lang', $locale)->get();
        return response()->json($allRows);
    }

    public function get_memebersdirectory($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('members_directories.*', 'assemblies.name as assemblyname')
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->orderBy('name','asc')
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_memebersdirectoryByAge($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->orderBy('age','asc')
        ->where('age','>',0)
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_memebersdirectoryBySeat($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        // ->orderBy('reservedseat','asc')
        // ->select(DB::raw('members_directories.reservedseat','members_directories.*'))
        ->where('seats', '<>', '-')
        ->where('seats', '<>', 0)
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_memebersdirectoryByBirth($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->orderBy('birthday','asc')
        ->where('birthday','<>','-')
        ->where('birthday','<>','')
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_memebersdirectoryByContact($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->orderBy('phonenumber','asc')
        ->where('phonenumber','<>','-')
        ->where('phonenumber','<>','')
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_memebersdirectorysubjects($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->select('qualification')
        // ->groupBy('qualification')
        ->where('qualification','<>','["-"]')
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->distinct()
        ->get();

        // $qualifications = array();
        // foreach($allRows as $row){
        //     $q = $row->qualification;
        //     echo $q;
        //     // $qualifications = $q;
        //     array_push($qualifications, array_values(json_decode($q)));
        // }

        // print_r(array_unique($qualifications) );
        // $uniquePids = array_unique(array_map(function ($i) { return $i['qualification']; }, $allRows));
        // $array = array_column($array, 'plan');

        // print_r($qualifications);
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_memebersdirectoryParty($tenure=false, $locale='en')
    {
        $allRows = DB::table('members_directories')
        ->select('partyassociation')
        ->groupBy('partyassociation')
        ->where('partyassociation','<>','-')
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_memebersdirectoryByDestrict($tenure=false, $locale='en')
    {
        $allRows = MembersDirectory::distinct()
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get(['District']);
        return response()->json($allRows);
    }
    public function get_memebersdirectoryByParty($tenure=false, $locale='en')
    {
        $allRows = MembersDirectory::distinct()
        ->where('members_directories.assembly_tenures_id', $tenure)
        ->where('members_directories.lang', $locale)
        ->get(['partyassociation']);
        $totalpartiespeople = DB::table('members_directories')
        ->where('members_directories.lang', $locale)
        ->orderBy('partyassociation')
        ->get()
        ->count();
        $partwithcount = array();
        foreach ($allRows as $row) {
            $rows = DB::table('members_directories')
            ->where('partyassociation', $row->partyassociation)
            ->where('members_directories.lang', $locale)
            ->get()
            ->count();
            array_push($partwithcount,['partyassociation'=>$row->partyassociation, 'count'=>$rows, 'total'=>$totalpartiespeople]);
        }
        // return $partwithcount;
        return response()->json($partwithcount);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows =  DB::table('members_directories')
        ->leftJoin('parties', 'parties.id', '=', 'members_directories.partyassociation')
        ->where('members_directories.lang', app()->getLocale())
        ->select('members_directories.*', 'parties.party_name', 'parties.party_type')
        ->get();
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        $partyList = Party::all()->where('lang', app()->getLocale());
        return view('membersdirectory', compact('allRows','assemblyTenure', 'partyList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $path = $request->file('image')->store('members');
        // Storage::putFile('members', $request->file('image'));
        $request->validate([
             'assembly_tenures_id' => 'required',
             'image' => 'required',
             'name' => 'required',
             'fatherhusbandname' => 'required',
             'birthday' => 'required',
             'placeofbirth' => 'required',
             'maritalstatus' => 'required',
             'children' => 'required',
             'religion' => 'required',
             'seattype' => 'required',
             'constituency' => 'required',
             'District' => 'required',
             'partyassociation' => 'required',
             'phonenumber' => 'required',
             'email' => 'required',
             'webaddress' => 'required',
             'presentaddress' => 'required',
             'permanentaddress' => 'required',
             'qualification' => 'required',
             'yearofpassing' => 'required',
             'party' => 'required',
             'previousposition' => 'required',
             'wooment' => 'required',
            ]);

        // dd($request->all());

        $table = new MembersDirectory;

        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->image = $request->image;
        $table->fatherhusbandname = $request->fatherhusbandname;
        $table->birthday = $request->birthday;
        $table->placeofbirth = $request->placeofbirth;
        $table->maritalstatus = $request->maritalstatus;
        $table->children = $request->children;
        $table->wooment = $request->wooment;
        $table->religion = $request->religion;
        $table->age = $request->age;
        // $table->agriculturist = $request->agriculturist;
        $table->seattype = $request->seattype;
        $table->seats = $request->seats;
        $table->constituency = $request->constituency;
        $table->District = $request->District;
        $table->partyassociation = $request->partyassociation;
        $table->phonenumber = $request->phonenumber;
        $table->email = $request->email;
        $table->webaddress = $request->webaddress;
        $table->presentaddress = $request->presentaddress;
        $table->permanentaddress = $request->permanentaddress;

        $table->qualification = json_encode($request->qualification);
        $table->yearofpassing = json_encode($request->yearofpassing);
        $table->iu = json_encode($request->iu);
        $table->edudetails = json_encode($request->edudetails);
        $table->previousposition = json_encode($request->previousposition);
        $table->govtbody = json_encode($request->govtbody);
        $table->party = json_encode($request->party);
        $table->pc_detail =json_encode($request->pc_detail);
        $table->pc_fromdate = json_encode($request->pc_fromdate);
        $table->pc_todate = json_encode($request->pc_todate);
        $table->vtc_counttry = json_encode($request->vtc_counttry);
        $table->vtc_purpose = json_encode($request->vtc_purpose);
        $table->vtc_duration = json_encode($request->vtc_duration);
        $table->pie_type = json_encode($request->pie_type);
        $table->vtc_country = json_encode($request->vtc_country);
        $table->vtc_participatedas = json_encode($request->vtc_participatedas);
        $table->vtc_eventdate = json_encode($request->vtc_eventdate);
        $table->ria_parliamentarybody = json_encode($request->ria_parliamentarybody);
        $table->ria_familyrelation = json_encode($request->ria_familyrelation);
        $table->ria_name = json_encode($request->ria_name);
        $table->ria_duration=json_encode($request->ria_duration);
        $table->moc_position=json_encode($request->moc_position);
        $table->moc_committee=json_encode($request->moc_committee);
        $table->moc_fromdate=json_encode($request->moc_fromdate);
        $table->moc_todate=json_encode($request->moc_todate);
        $table->moc_fromdate1=json_encode($request->moc_fromdate1);
        $table->moc_todate1=json_encode($request->moc_todate1);
        $table->mian_aothdate=$request->mian_aothdate;
        $table->memberfromdate=$request->memberfromdate;
        $table->membertodate=$request->membertodate;

        $table->lang = app()->getLocale();

       if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $table->image =  $imageName;
       }

        $table->save();
        return redirect()->route('membersdirectory.index')->with(['success'=>'Data has been Saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ignore, $id)
    {
        $singleRow = MembersDirectory::find($id);
        $allRows =  DB::table('members_directories')
        ->leftJoin('parties', 'parties.id', '=', 'members_directories.partyassociation')
        ->where('members_directories.lang', app()->getLocale())
        ->select('members_directories.*', 'parties.party_name', 'parties.party_type')
        ->get();

        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        $partyList = Party::all()->where('lang', app()->getLocale());
        return view('membersdirectory', compact('allRows','singleRow','assemblyTenure', 'partyList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ignore,Request $request, $id)
    {

        $request->validate([
            'assembly_tenures_id' => 'required',
            //  'image' => 'required',
             'name' => 'required',
             'fatherhusbandname' => 'required',
             'birthday' => 'required',
             'placeofbirth' => 'required',
             'maritalstatus' => 'required',
             'children' => 'required',
             'religion' => 'required',
             'seattype' => 'required',
             'constituency' => 'required',
             'District' => 'required',
             'partyassociation' => 'required',
             'phonenumber' => 'required',
             'email' => 'required',
             'webaddress' => 'required',
             'presentaddress' => 'required',
             'permanentaddress' => 'required',
             'qualification' => 'required',
             'yearofpassing' => 'required',
             'party' => 'required',
             'previousposition' => 'required',
             'wooment' => 'required',
        ]);

        $table = MembersDirectory::find($id);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $table->image =  $imageName;
        }else{
            $table->image = $table->image;
        }

        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->fatherhusbandname = $request->fatherhusbandname;
        $table->birthday = $request->birthday;
        $table->placeofbirth = $request->placeofbirth;
        $table->maritalstatus = $request->maritalstatus;
        $table->children = $request->children;
        $table->wooment = $request->wooment;
        $table->religion = $request->religion;
        $table->age = $request->age;
        // $table->agriculturist = $request->agriculturist;
        $table->seattype = $request->seattype;
        $table->seats = $request->seats;
        $table->constituency = $request->constituency;
        $table->District = $request->District;
        $table->partyassociation = $request->partyassociation;
        $table->phonenumber = $request->phonenumber;
        $table->email = $request->email;
        $table->webaddress = $request->webaddress;
        $table->presentaddress = $request->presentaddress;
        $table->permanentaddress = $request->permanentaddress;

        $table->qualification = json_encode($request->qualification);
        $table->yearofpassing = json_encode($request->yearofpassing);
        $table->iu = json_encode($request->iu);
        $table->edudetails = json_encode($request->edudetails);
        $table->previousposition = json_encode($request->previousposition);
        $table->govtbody = json_encode($request->govtbody);
        $table->party = json_encode($request->party);
        $table->pc_detail =json_encode($request->pc_detail);
        $table->pc_fromdate = json_encode($request->pc_fromdate);
        $table->pc_todate = json_encode($request->pc_todate);
        $table->vtc_counttry = json_encode($request->vtc_counttry);
        $table->vtc_purpose = json_encode($request->vtc_purpose);
        $table->vtc_duration = json_encode($request->vtc_duration);
        $table->pie_type = json_encode($request->pie_type);
        $table->vtc_country = json_encode($request->vtc_country);
        $table->vtc_participatedas = json_encode($request->vtc_participatedas);
        $table->vtc_eventdate = json_encode($request->vtc_eventdate);
        $table->ria_parliamentarybody = json_encode($request->ria_parliamentarybody);
        $table->ria_familyrelation = json_encode($request->ria_familyrelation);
        $table->ria_name = json_encode($request->ria_name);
        $table->ria_duration=json_encode($request->ria_duration);
        $table->moc_position=json_encode($request->moc_position);
        $table->moc_committee=json_encode($request->moc_committee);
        $table->moc_fromdate=json_encode($request->moc_fromdate);
        $table->moc_todate=json_encode($request->moc_todate);
        $table->moc_fromdate1=json_encode($request->moc_fromdate1);
        $table->moc_todate1=json_encode($request->moc_todate1);
        $table->mian_aothdate=$request->mian_aothdate;
        $table->memberfromdate=$request->memberfromdate;
        $table->membertodate=$request->membertodate;
        $table->save();
        return redirect()->route('membersdirectory.index')->with(['success'=>'Data has been Updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = MembersDirectory::find($id);
        $singleRow->delete();
        return redirect()->route('membersdirectory.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
