@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Members Directory Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <p>Personal Info </p>
            </div>
        </div>
        <hr>
        <form action="@if(isset($singleRow)) {{ route('membersdirectory.update', ['membersdirectory'=>$singleRow->id ]) }} @else {{ route('membersdirectory.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
                
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Assembly Tenure</label>
                        <select name="assembly_tenures_id" class="form-control">
                           @forelse($assemblyTenure as $assemblyTenure)
                                <option value="{{$assemblyTenure->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assemblyTenure->id) selected @endif  @endif >{{$assemblyTenure->fromdate}} To {{$assemblyTenure->todate}}</option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Name </label>
                        <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">image </label>
                        <input type="file" name="image" value="@if(isset($singleRow)){{$singleRow->image}}@endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Father/Husband name </label>
                        <input type="text" name="fatherhusbandname" value="@if(isset($singleRow)){{$singleRow->fatherhusbandname}}@else - @endif" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Reserve seat for women</label>
                        <select name="wooment" id="" class="form-control">
                            <option value="0" @if(isset($singleRow)) @if($singleRow->wooment == '0') selected @endif @endif>No</option>
                            <option value="1" @if(isset($singleRow)) @if($singleRow->wooment == '1') selected @endif @endif>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Birth Day</label>
                        <input type="date" name="birthday" value="@if(isset($singleRow)){{$singleRow->birthday}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="number" name="age" value="@if(isset($singleRow)){{$singleRow->age}}@else 0 @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Place of Birth </label>
                        <input type="text" name="placeofbirth" value="@if(isset($singleRow)){{$singleRow->placeofbirth}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Marital Status </label>
                        <select name="maritalstatus" class="form-control">
                            <option value="-" >Select Status</option>
                            <option value="Married" @if(isset($singleRow)) @if($singleRow->maritalstatus == 'Married') selected @endif @endif>Married</option>
                            <option value="Un-Married"  @if(isset($singleRow)) @if($singleRow->maritalstatus == 'Un-Married') selected @endif @endif>Un-Married</option>
                            <option value="Divorced"  @if(isset($singleRow)) @if($singleRow->maritalstatus == 'Divorced') selected @endif @endif>Divorced</option>
                            <option value="Widow" @if(isset($singleRow)) @if($singleRow->maritalstatus == 'Widow') selected @endif @endif>Widow</option>
                            <option value="Single" @if(isset($singleRow)) @if($singleRow->maritalstatus == 'Single') selected @endif @endif>Single</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Children</label>
                        <input type="text" name="children" value="@if(isset($singleRow)){{$singleRow->children}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                    
                        <label for="">Religion</label>
                        <select name="religion" class="form-control">
                            <option value="Islam" @if(isset($singleRow)) @if($singleRow->religion == 'Islam') selected @endif @endif>Islam</option>
                            <option value="Christianity" @if(isset($singleRow)) @if($singleRow->religion == 'Christianity') selected @endif @endif>Christianity</option>
                            <option value="Hinduism" @if(isset($singleRow)) @if($singleRow->religion == 'Hinduism') selected @endif @endif>Hinduism</option>
                            <option value="Atheist" @if(isset($singleRow)) @if($singleRow->religion == 'Atheist') selected @endif @endif>Atheist</option>
                            <option value="Zoroastrianism" @if(isset($singleRow)) @if($singleRow->religion == 'Zoroastrianism') selected @endif @endif>Zoroastrianism</option>
                            <option value="Sikhism" @if(isset($singleRow)) @if($singleRow->religion == 'Sikhism') selected @endif @endif>Sikhism</option>
                        </select>
                    </div>
                </div>
            </div>
            <p> Political Info </p>
            <hr>
            <div class="row">               
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Seat Type </label>
                        <select name="seattype" class="form-control select2" tabindex="-1" aria-hidden="true">
                            <option value="-">Select Seat</option>
                            <option value="General Seat" @if(isset($singleRow)) @if($singleRow->seattype == 'General Seat') selected @endif @endif>General Seat</option>
                            <option value="Reserved Seat" @if(isset($singleRow)) @if($singleRow->seattype == 'Reserved Seat') selected @endif @endif>Reserved Seat</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Seats </label>
                        <input type="number" name="seats" value="@if(isset($singleRow)){{$singleRow->seats}}@else 0 @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">District </label>
                        <input type="text" name="District" value="@if(isset($singleRow)){{$singleRow->District}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Constituency </label>
                        <input type="text" name="constituency" value="@if(isset($singleRow)){{$singleRow->constituency}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Party Association </label>
                        <input type="text" name="partyassociation" value="@if(isset($singleRow)){{$singleRow->partyassociation}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Oath Taken on </label>
                        <input type="text" name="mian_aothdate" value="@if(isset($singleRow)){{$singleRow->mian_aothdate}}@else - @endif" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="text" name="memberfromdate" value="@if(isset($singleRow)){{$singleRow->memberfromdate}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date </label>
                        <input type="text" name="membertodate" value="@if(isset($singleRow)){{$singleRow->membertodate}}@else - @endif" class="form-control">
                    </div>
                </div>

            </div>
            <p>Contact Info</p>
            <hr>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" name="phonenumber" value="@if(isset($singleRow)){{$singleRow->phonenumber}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Email </label>
                        <input type="text" name="email" value="@if(isset($singleRow)){{$singleRow->email}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Web Address </label>
                        <input type="text" name="webaddress" value="@if(isset($singleRow)){{$singleRow->webaddress}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Present Address </label>
                        <input type="text" name="presentaddress" value="@if(isset($singleRow)){{$singleRow->presentaddress}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Permanent Address </label>
                        <input type="text" name="permanentaddress" value="@if(isset($singleRow)){{$singleRow->permanentaddress}}@else - @endif" class="form-control">
                    </div>
                </div>
            </div>

            <p style="border-bottom:solid 1px; padding-bottom:10px;">Positions &nbsp;&nbsp;&nbsp;<button class="btn btn-primary addmoc"  style="padding: 0px 10px 0 10px;">+</button></p>
           

            @if(isset($singleRow))

            @foreach(json_decode($singleRow->moc_position) as $key => $moc_position)
            
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Ministry</label>
                        <input type="text" name="moc_position[]" value="{{json_decode($singleRow->moc_position)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" name="moc_fromdate[]" value="{{json_decode($singleRow->moc_fromdate)[$key]}}" class="form-control">
                    </div>
                </div> 

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="date" name="moc_todate[]" value="{{json_decode($singleRow->moc_todate)[$key]}}" class="form-control">
                    </div>
                </div>   
            </div>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Committee</label>
                        <input type="text" name="moc_committee[]" value="{{json_decode($singleRow->moc_committee)[$key]}}" value="-" class="form-control">
                    </div>
                </div> 
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" name="moc_fromdate1[]" value="{{json_decode($singleRow->moc_fromdate1)[$key]}}" class="form-control">
                    </div>
                </div> 

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="date" name="moc_todate1[]" value="{{json_decode($singleRow->moc_todate1)[$key]}}" class="form-control">
                    </div>
                </div>   
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Ministry</label>
                        <input type="text" name="moc_position[]" value="-" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" name="moc_fromdate[]" class="form-control">
                    </div>
                </div> 

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="date" name="moc_todate[]" class="form-control">
                    </div>
                </div>   
            </div>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Committee</label>
                        <input type="text" name="moc_committee[]" value="-" class="form-control">
                    </div>
                </div> 
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" name="moc_fromdate1[]" class="form-control">
                    </div>
                </div> 

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="date" name="moc_todate1[]" class="form-control">
                    </div>
                </div>   
            </div>
            @endif
            <span class="addmocbody"></span>

            <p>Education Info &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addqualification"  style="padding: 0px 10px 0 10px;">+</button> </p>
            <hr>
            @if(isset($singleRow))

            @foreach(json_decode($singleRow->qualification) as $key => $qualification)
            <div class="row">
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Qualification{{$key}} </label>
                        <select name="qualification[]" class="form-control">
                            <option value="-">Select Qualification</option>
                                <option value="Ph.D">Ph.D</option>
                                <option value="MPhil">MPhil</option>
                                <option value="LL.M">LL.M.</option>
                                <option value="M Pharmacy">M Pharmacy</option>
                                <option value="M.Sc.(Hons)">M.Sc.(Hons)</option>
                                <option value="M.Com">M.Com</option>
                                <option value="M.Sc">M.Sc.</option>
                                <option value="MBA">MBA</option>
                                <option value="Master in Surgery">Master in Surgery</option>
                                <option value="MA">MA</option>
                                <option value="MPA">MPA</option>
                                <option value="MCIT">MCIT</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="Shahdat-ul-Almia">Shahdat-ul-Almia</option>
                                <option value="MRCP">MRCP</option>
                                <option value="MCPS">MCPS</option>
                                <option value="FCPS">FCPS</option>
                                <option value="FRCP">FRCP</option>
                                <option value="FRCS">FRCS</option>
                                <option value="MACP">MACP</option>
                                <option value="PGD">PGD</option>
                                <option value="L.L.B (Hons)">L.L.B (Hons)</option>
                                <option value="Diploma in Computer Science">Diploma in Computer Science</option>
                                <option value="Advance Diploma in Business Administration">Advance Diploma in Business Administration</option>
                                <option value="Diploma in Cardiology">Diploma in Cardiology</option>
                                <option value="Diploma in Gyanee">Diploma in Gyanee</option>
                                <option value="Certification in Global Financial Markets">Certification in Global Financial Markets</option>
                                <option value="Diploma in Labour Laws">Diploma in Labour Laws</option>
                                <option value="Diploma in Taxation Laws">Diploma in Taxation Laws</option>
                                <option value="B.Com">B.Com</option>
                                <option value="L.L.B">L.L.B</option>
                                <option value="B.Ed">B.Ed.</option>
                                <option value="B.Sc.(Hons)">B.Sc.(Hons)</option>
                                <option value="MBBS">MBBS</option>
                                <option value="BA">BA</option>
                                <option value="BCS">BCS</option>
                                <option value="BCIT">BCIT</option>
                                <option value="BE">BE</option>
                                <option value="B.Sc. (Engr.)">B.Sc. (Engr.)</option>
                                <option value="B.B.A">B.B.A</option>
                                <option value="B.Sc">B.Sc.</option>
                                <option value="BA B.Ed">BA B.Ed.</option>
                                <option value="Graduation">Graduation</option>
                                <option value="B.B.A. (Hons)">B.B.A. (Hons)</option>
                                <option value="B Pharmacy">B Pharmacy</option>
                                <option value="Bachelor of Architect">Bachelor of Architect</option>
                                <option value="BA (Hons.)">BA (Hons.)</option>
                                <option value="Diploma in Business Administration">Diploma in Business Administration</option>
                                <option value="Diploma in Interior Design">Diploma in Interior Design</option>
                                <option value="Diploma in Physical Education">Diploma in Physical Education</option>
                                <option value="D.Com">D.Com.</option>
                                <option value="Diploma of Associate Engineering">Diploma of Associate Engineering</option>
                                <option value="Senior Cambridge">Senior Cambridge</option>
                                <option value="F.Sc">F.Sc.</option>
                                <option value="A-Level">A-Level</option>
                                <option value="F.A">F.A</option>
                                <option value="ICS">ICS</option>
                                <option value="Certificate">Certificate</option>
                                <option value="O-Level">O-Level</option>
                                <option value="Matriculation">Matriculation</option>
                                <option value="Tanzeem-ul-Madaras">Tanzeem-ul-Madaras</option>
                                <option value="Under Matric">Under Matric</option>
                                <option value="Middle">Middle</option>
                                <option value="Master of Arts (International Relations)">Master of Arts (International Relations)</option>
                                <option value="Barrister of Law">Barrister of Law</option>
                                <option value="Army Special Certification of Education">Army Special Certification of Education</option>
                                <option value="M.S. (Orthopaedics)">M.S. (Orthopaedics)</option>
                                <option value="M.Ed">M.Ed.</option>
                            </select>
                        
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Year of Passing </label>
                        <input type="text"  name="yearofpassing[]" value="{{json_decode($singleRow->yearofpassing)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Institute/University</label>
                        <input type="text" name="iu[]" value="{{json_decode($singleRow->iu)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Details</label>
                        <input type="text" name="edudetails[]" value="{{json_decode($singleRow->edudetails)[$key]}}" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-1">
                    <a href="#" class="btn btn-danger remqualification" style="margin-top: 23px;">-</a>
                </div>
            </div>
            @endforeach
            
            @else
           
            <div class="row">
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Qualification </label>
                        <select name="qualification[]" class="form-control">
                            <option value="-">Select Qualification</option>
                                <option value="Ph.D">Ph.D</option>
                                <option value="MPhil">MPhil</option>
                                <option value="LL.M">LL.M.</option>
                                <option value="M Pharmacy">M Pharmacy</option>
                                <option value="M.Sc.(Hons)">M.Sc.(Hons)</option>
                                <option value="M.Com">M.Com</option>
                                <option value="M.Sc">M.Sc.</option>
                                <option value="MBA">MBA</option>
                                <option value="Master in Surgery">Master in Surgery</option>
                                <option value="MA">MA</option>
                                <option value="MPA">MPA</option>
                                <option value="MCIT">MCIT</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="Shahdat-ul-Almia">Shahdat-ul-Almia</option>
                                <option value="MRCP">MRCP</option>
                                <option value="MCPS">MCPS</option>
                                <option value="FCPS">FCPS</option>
                                <option value="FRCP">FRCP</option>
                                <option value="FRCS">FRCS</option>
                                <option value="MACP">MACP</option>
                                <option value="PGD">PGD</option>
                                <option value="L.L.B (Hons)">L.L.B (Hons)</option>
                                <option value="Diploma in Computer Science">Diploma in Computer Science</option>
                                <option value="Advance Diploma in Business Administration">Advance Diploma in Business Administration</option>
                                <option value="Diploma in Cardiology">Diploma in Cardiology</option>
                                <option value="Diploma in Gyanee">Diploma in Gyanee</option>
                                <option value="Certification in Global Financial Markets">Certification in Global Financial Markets</option>
                                <option value="Diploma in Labour Laws">Diploma in Labour Laws</option>
                                <option value="Diploma in Taxation Laws">Diploma in Taxation Laws</option>
                                <option value="B.Com">B.Com</option>
                                <option value="L.L.B">L.L.B</option>
                                <option value="B.Ed">B.Ed.</option>
                                <option value="B.Sc.(Hons)">B.Sc.(Hons)</option>
                                <option value="MBBS">MBBS</option>
                                <option value="BA">BA</option>
                                <option value="BCS">BCS</option>
                                <option value="BCIT">BCIT</option>
                                <option value="BE">BE</option>
                                <option value="B.Sc. (Engr.)">B.Sc. (Engr.)</option>
                                <option value="B.B.A">B.B.A</option>
                                <option value="B.Sc">B.Sc.</option>
                                <option value="BA B.Ed">BA B.Ed.</option>
                                <option value="Graduation">Graduation</option>
                                <option value="B.B.A. (Hons)">B.B.A. (Hons)</option>
                                <option value="B Pharmacy">B Pharmacy</option>
                                <option value="Bachelor of Architect">Bachelor of Architect</option>
                                <option value="BA (Hons.)">BA (Hons.)</option>
                                <option value="Diploma in Business Administration">Diploma in Business Administration</option>
                                <option value="Diploma in Interior Design">Diploma in Interior Design</option>
                                <option value="Diploma in Physical Education">Diploma in Physical Education</option>
                                <option value="D.Com">D.Com.</option>
                                <option value="Diploma of Associate Engineering">Diploma of Associate Engineering</option>
                                <option value="Senior Cambridge">Senior Cambridge</option>
                                <option value="F.Sc">F.Sc.</option>
                                <option value="A-Level">A-Level</option>
                                <option value="F.A">F.A</option>
                                <option value="ICS">ICS</option>
                                <option value="Certificate">Certificate</option>
                                <option value="O-Level">O-Level</option>
                                <option value="Matriculation">Matriculation</option>
                                <option value="Tanzeem-ul-Madaras">Tanzeem-ul-Madaras</option>
                                <option value="Under Matric">Under Matric</option>
                                <option value="Middle">Middle</option>
                                <option value="Master of Arts (International Relations)">Master of Arts (International Relations)</option>
                                <option value="Barrister of Law">Barrister of Law</option>
                                <option value="Army Special Certification of Education">Army Special Certification of Education</option>
                                <option value="M.S. (Orthopaedics)">M.S. (Orthopaedics)</option>
                                <option value="M.Ed">M.Ed.</option>
                            </select>
                        
                    </div>
                </div>
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Year of Passing </label>
                        <input type="text"  name="yearofpassing[]" value="-" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Institute/University</label>
                        <input type="text" name="iu[]" value="-" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Details</label>
                        <input type="text" name="edudetails[]" value="-" class="form-control">
                    </div>
                </div>
                
               
            </div>
            @endif
            <span class="addqualificationbody">
            </span>
            <p style="border-bottom:solid 1px; padding-bottom:10px;">Previous Official Positions &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addprevious"  style="padding: 0px 10px 0 10px;">+</button></p>
            @if(isset($singleRow))

            @foreach(json_decode($singleRow->previousposition) as $key => $previousposition)
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Previous official positions</label>
                        <select name="previousposition[]" class="form-control">
                            <option value="-">Select One..</option>
                            <option value="Baitul Maal Committee">Baitul Maal Committee</option>
                            <option value="Cattle Market Management Company">Cattle Market Management Company</option>
                            <option value="Chief Minister Complaint Cell">Chief Minister Complaint Cell</option>
                            <option value="Chief Minister, Punjab">Chief Minister, Punjab</option>
                            <option value="Corporation, Gujranwala">Corporation, Gujranwala</option>
                            <option value="Crime Control Committe">Crime Control Committe</option>
                            <option value="District Council">District Council</option>
                            <option value="District Education Advisory Committee">District Education Advisory Committee</option>
                            <option value="District Khidmat Committee">District Khidmat Committee</option>
                            <option value="District Nazim, Shakargarh">District Nazim, Shakargarh</option>
                            <option value="District Public Safety Police Complaint Commission">District Public Safety Police Complaint Commission</option>
                            <option value="Divisional Darbar">Divisional Darbar</option>
                            <option value="Education Department">Education Department</option>
                            <option value="Federal Government">Federal Government</option>
                            <option value="Governer of the Punjab">Governer of the Punjab</option>
                            <option value="Govt. of Sindh">Govt. of Sindh</option>
                            <option value="Govt. of the Punjab">Govt. of the Punjab</option>
                            <option value="Health Department">Health Department</option>
                            <option value="High Court">High Court</option>
                            <option value="Home Department">Home Department</option>
                            <option value="Law Department">Law Department</option>
                            <option value="Local Government">Local Government</option>
                            <option value="Majlis-e-Shoora">Majlis-e-Shoora</option>
                            <option value="Market Committee">Market Committee</option>
                            <option value="Markiz Council">Markiz Council</option>
                            <option value="Metropolitian Corporation, Lahore">Metropolitian Corporation, Lahore</option>
                            <option value="Multan Cess Committee">Multan Cess Committee</option>
                            <option value="Multan Development Authority">Multan Development Authority</option>
                            <option value="Multan Waste Management Company">Multan Waste Management Company</option>
                            <option value="Municipal Committee">Municipal Committee</option>
                            <option value="Municipal Corporation">Municipal Corporation</option>
                            <option value="National Assembly of Pakistan">National Assembly of Pakistan</option>
                            <option value="Pakistan Air Force">Pakistan Air Force</option>
                            <option value="Pakistan Army">Pakistan Army</option>
                            <option value="Pakistan Cricket Board">Pakistan Cricket Board</option>
                            <option value="Pakistan International Airline">Pakistan International Airline</option>
                            <option value="Police Department">Police Department</option>
                            <option value="Provincial Assembly of Sindh">Provincial Assembly of Sindh</option>
                            <option value="Provincial Assembly of the Punjab">Provincial Assembly of the Punjab</option>
                            <option value="Provincial Council of the Punjab">Provincial Council of the Punjab</option>
                            <option value="Punjab Heritage Fund">Punjab Heritage Fund </option>
                            <option value="Punjab Legislative Council">Punjab Legislative Council</option>
                            <option value="Punjab Norcotics Committee">Punjab Norcotics Committee</option>
                            <option value="Punjab Privatization Commission">Punjab Privatization Commission</option>
                            <option value="Punjab Procurement Regulatory Authority">Punjab Procurement Regulatory Authority</option>
                            <option value="Quaid-e-Azam Solar Park Company">Quaid-e-Azam Solar Park Company</option>
                            <option value="Senate of Pakistan">Senate of Pakistan</option>
                            <option value="Social Action Board">Social Action Board</option>
                            <option value="State Bank of Pakistan">State Bank of Pakistan</option>
                            <option value="Tehsil Council">Tehsil Council</option>
                            <option value="Tehsil Nazim, Shakargarh">Tehsil Nazim, Shakargarh</option>
                            <option value="Town Committee">Town Committee</option>
                            <option value="Water and Sanitation Agency">Water and Sanitation Agency</option>
                            <option value="West Pakistan Assembly">West Pakistan Assembly</option>
                            <option value="Women Crises Center, Vehari">Women Crises Center, Vehari</option>
                        </select>
                
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">Govt. Body</div>
                    <input type="text" class="form-control" value="{{json_decode($singleRow->govtbody)[$key]}}" name="govtbody[]">
                </div>
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Previous official positions</label>
                        <select name="previousposition[]" class="form-control">
                            <option value="-">Select One..</option>
                            <option value="Baitul Maal Committee">Baitul Maal Committee</option>
                            <option value="Cattle Market Management Company">Cattle Market Management Company</option>
                            <option value="Chief Minister Complaint Cell">Chief Minister Complaint Cell</option>
                            <option value="Chief Minister, Punjab">Chief Minister, Punjab</option>
                            <option value="Corporation, Gujranwala">Corporation, Gujranwala</option>
                            <option value="Crime Control Committe">Crime Control Committe</option>
                            <option value="District Council">District Council</option>
                            <option value="District Education Advisory Committee">District Education Advisory Committee</option>
                            <option value="District Khidmat Committee">District Khidmat Committee</option>
                            <option value="District Nazim, Shakargarh">District Nazim, Shakargarh</option>
                            <option value="District Public Safety Police Complaint Commission">District Public Safety Police Complaint Commission</option>
                            <option value="Divisional Darbar">Divisional Darbar</option>
                            <option value="Education Department">Education Department</option>
                            <option value="Federal Government">Federal Government</option>
                            <option value="Governer of the Punjab">Governer of the Punjab</option>
                            <option value="Govt. of Sindh">Govt. of Sindh</option>
                            <option value="Govt. of the Punjab">Govt. of the Punjab</option>
                            <option value="Health Department">Health Department</option>
                            <option value="High Court">High Court</option>
                            <option value="Home Department">Home Department</option>
                            <option value="Law Department">Law Department</option>
                            <option value="Local Government">Local Government</option>
                            <option value="Majlis-e-Shoora">Majlis-e-Shoora</option>
                            <option value="Market Committee">Market Committee</option>
                            <option value="Markiz Council">Markiz Council</option>
                            <option value="Metropolitian Corporation, Lahore">Metropolitian Corporation, Lahore</option>
                            <option value="Multan Cess Committee">Multan Cess Committee</option>
                            <option value="Multan Development Authority">Multan Development Authority</option>
                            <option value="Multan Waste Management Company">Multan Waste Management Company</option>
                            <option value="Municipal Committee">Municipal Committee</option>
                            <option value="Municipal Corporation">Municipal Corporation</option>
                            <option value="National Assembly of Pakistan">National Assembly of Pakistan</option>
                            <option value="Pakistan Air Force">Pakistan Air Force</option>
                            <option value="Pakistan Army">Pakistan Army</option>
                            <option value="Pakistan Cricket Board">Pakistan Cricket Board</option>
                            <option value="Pakistan International Airline">Pakistan International Airline</option>
                            <option value="Police Department">Police Department</option>
                            <option value="Provincial Assembly of Sindh">Provincial Assembly of Sindh</option>
                            <option value="Provincial Assembly of the Punjab">Provincial Assembly of the Punjab</option>
                            <option value="Provincial Council of the Punjab">Provincial Council of the Punjab</option>
                            <option value="Punjab Heritage Fund">Punjab Heritage Fund </option>
                            <option value="Punjab Legislative Council">Punjab Legislative Council</option>
                            <option value="Punjab Norcotics Committee">Punjab Norcotics Committee</option>
                            <option value="Punjab Privatization Commission">Punjab Privatization Commission</option>
                            <option value="Punjab Procurement Regulatory Authority">Punjab Procurement Regulatory Authority</option>
                            <option value="Quaid-e-Azam Solar Park Company">Quaid-e-Azam Solar Park Company</option>
                            <option value="Senate of Pakistan">Senate of Pakistan</option>
                            <option value="Social Action Board">Social Action Board</option>
                            <option value="State Bank of Pakistan">State Bank of Pakistan</option>
                            <option value="Tehsil Council">Tehsil Council</option>
                            <option value="Tehsil Nazim, Shakargarh">Tehsil Nazim, Shakargarh</option>
                            <option value="Town Committee">Town Committee</option>
                            <option value="Water and Sanitation Agency">Water and Sanitation Agency</option>
                            <option value="West Pakistan Assembly">West Pakistan Assembly</option>
                            <option value="Women Crises Center, Vehari">Women Crises Center, Vehari</option>
                        </select>
                
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">Govt. Body</div>
                    <input type="text" class="form-control" value="@if(isset($singleRow)){{$singleRow->govtbody}}@else - @endif" name="govtbody[]">
                </div>
            </div>
            @endif
            <span class="addpreviousbody"></span>
            <p style="border-bottom:solid 1px; padding-bottom:10px;">Political Career &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addpolitical"  style="padding: 0px 10px 0 10px;">+</button></p>
           

            @if(isset($singleRow))

            @foreach(json_decode($singleRow->party) as $key => $party)
            <div class="row">
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Party</label>
                        <input type="text" name="party[]" value="{{json_decode($singleRow->party)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Detail</label>
                        <input type="text" name="pc_detail[]" value="{{json_decode($singleRow->pc_detail)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="text" name="pc_fromdate[]" value="{{json_decode($singleRow->pc_fromdate)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="text" name="pc_todate[]" value="{{json_decode($singleRow->pc_todate)[$key]}}" class="form-control">
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Party</label>
                        <input type="text" name="party[]" value="@if(isset($singleRow)){{$singleRow->party}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Detail</label>
                        <input type="text" name="pc_detail[]" value="@if(isset($singleRow)){{$singleRow->pc_detail}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="text" name="pc_fromdate[]" value="@if(isset($singleRow)){{$singleRow->pc_fromdate}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="text" name="pc_todate[]" value="@if(isset($singleRow)){{$singleRow->pc_todate}}@else - @endif" class="form-control">
                    </div>
                </div>
            </div>
            @endif
            <span class="addpoliticalbody"></span>
            <p  style="border-bottom:solid 1px; padding-bottom:10px;">Visits to Countries &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addvisits" style="padding: 0px 10px 0 10px;">+</button></p>

            @if(isset($singleRow))
            @foreach(json_decode($singleRow->vtc_counttry) as $key => $vtc_counttry)
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" name="vtc_counttry[]" value="{{json_decode($singleRow->vtc_counttry)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Purpose</label>
                        <input type="text" name="vtc_purpose[]" value="{{json_decode($singleRow->vtc_purpose)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="text" name="vtc_duration[]" value="{{json_decode($singleRow->vtc_duration)[$key]}}" class="form-control">
                    </div>
                </div>
                
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" name="vtc_counttry[]" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Purpose</label>
                        <input type="text" name="vtc_purpose[]" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="text" name="vtc_duration[]" value="" class="form-control">
                    </div>
                </div>
                
            </div>
            @endif
            <span class="addvisitsbody"></span>
            <p style="border-bottom:solid 1px; padding-bottom:10px;">Participation in Events &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addevent" style="padding: 0px 10px 0 10px;">+</button></p>
            @if(isset($singleRow))
            @foreach(json_decode($singleRow->pie_type) as $key => $pie_type)
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Event type</label>
                        <input type="text" name="pie_type[]" value="{{json_decode($singleRow->pie_type)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" name="vtc_country[]" value="{{json_decode($singleRow->vtc_country)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Participated As</label>
                        <input type="text" name="vtc_participatedas[]" value="{{json_decode($singleRow->vtc_participatedas)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Event Date</label>
                        <input type="text" name="vtc_eventdate[]" value="{{json_decode($singleRow->vtc_eventdate)[$key]}}" class="form-control">
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Event type</label>
                        <input type="text" name="pie_type[]" value="@if(isset($singleRow)){{$singleRow->pie_type}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" name="vtc_country[]" value="@if(isset($singleRow)){{$singleRow->vtc_country}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Participated As</label>
                        <input type="text" name="vtc_participatedas[]" value="@if(isset($singleRow)){{$singleRow->vtc_participatedas}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Event Date</label>
                        <input type="text" name="vtc_eventdate[]" value="@if(isset($singleRow)){{$singleRow->vtc_eventdate}}@else - @endif" class="form-control">
                    </div>
                </div>
            </div>
            @endif
            <span class="addeventbody"></span>
            <p style="border-bottom:solid 1px; padding-bottom:10px;">Relatives in Assemblies &nbsp;&nbsp;&nbsp; <button class="btn btn-primary addrelative" style="padding: 0px 10px 0 10px;">+</button></p>
           
            @if(isset($singleRow))
            @foreach(json_decode($singleRow->ria_parliamentarybody) as $key => $ria_parliamentarybody)
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Parliamentary Body</label>
                        <input type="text" name="ria_parliamentarybody[]" value="{{json_decode($singleRow->ria_parliamentarybody)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Family Rrelation</label>
                        <input type="text" name="ria_familyrelation[]" value="{{json_decode($singleRow->ria_familyrelation)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="ria_name[]" value="{{json_decode($singleRow->ria_name)[$key]}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="text" name="ria_duration[]" value="{{json_decode($singleRow->ria_duration)[$key]}}" class="form-control">
                    </div>
                </div>
                
            </div>
            @endforeach

            @else
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Parliamentary Body</label>
                        <input type="text" name="ria_parliamentarybody[]" value="@if(isset($singleRow)){{$singleRow->ria_parliamentarybody}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Family Rrelation</label>
                        <input type="text" name="ria_familyrelation[]" value="@if(isset($singleRow)){{$singleRow->ria_familyrelation}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="ria_name[]" value="@if(isset($singleRow)){{$singleRow->ria_name}}@else - @endif" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">                  
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="text" name="ria_duration[]" value="@if(isset($singleRow)){{$singleRow->ria_duration}}@else - @endif" class="form-control">
                    </div>
                </div>
                
            </div>
            @endif
            <span class="addrelativebody"></span>
            <hr>
            <input type="submit" class="btn btn-primary" value="Save">
        </form>
        <br>
        @foreach($errors->all() as $error)
<div class="alert alert-danger"> {{$error}} </div>
@endforeach  
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    
  </div>

  <!-- /.box-footer-->
</div>
<!-- /.box -->

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Members Directory Data</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <table class="table table-light">
          <thead class="thead-light">
            <tr>
              <th width="">ID</th>
              <th width="%">Image</th>
              <!-- <th width="%">Assembly Tenure</th> -->
              <th width="%">Name</th>
              <th width="%">Birth Day</th>
              <th width="%">Party Association</th>
              <th width="%">Constituency</th>
              <th width="%">Contact</th>
              <th width="%">Address</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td> <img src="{{ url('uploads') }}/{{$about->image}}" width="50" height="50"> </td>
              <!-- <td>{{$about->assembly_tenures_id}}</td> -->
              <td>{{$about->name}}</td>
              <td>{{$about->birthday}}</td>
              <td>{{$about->partyassociation}}</td>
              <td>{{$about->constituency}}</td>
              <td>{{$about->phonenumber}}</td>
              <td>{{$about->permanentaddress}}</td>
              <td>
                <a href="{{ route('membersdirectory.edit', ['membersdirectory' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('membersdirectory.destroy', ['membersdirectory'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="17" style="text-align:center;">No Data Found</td>
            </tr>
          @endforelse
          </tbody>
        </table>
  </div>

  <!-- /.box-footer-->
</div>
</section>
<!-- /.content -->

@stop