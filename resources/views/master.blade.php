<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Sep 2020 15:17:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PAS PK | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home', app()->getLocale()) }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Pas</b>PK</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        @foreach (config('app.available_locales') as $locale)
            <li class="dropdown messages-menu">
                <a class="nav-link"
                href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$locale,0]) }}"
                    @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>
                    @if($locale == 'en')
                        Eng
                    @endif
                    @if($locale == 'ur')
                        Urdu
                    @endif
                    @if($locale == 'sd')
                        Sindhi
                    @endif
                  </a>
            </li>
        @endforeach
    </ul>
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 tasks</li>
              
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('dist/img/logo.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">PAS PK</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('dist/img/logo.png')}}" class="img-circle" alt="User Image">

                <p>
                  PasPK Admin
                  <small>Member since May. 2021</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->

                  <a class="btn btn-default btn-flat" href="{{ route('logout', app()->getLocale()) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('dist/img/logo.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>PAS PK</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=""><a href="{{ route('assembly.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Assembly</a></li>     
        <li class=""><a href="{{ route('assemblytenure.index', app()->getLocale()) }}"><i class="fa fa-calendar"></i> Assembly Tenure</a></li>     
        <li class=""><a href="{{ route('parliamentaryyear.index', app()->getLocale()) }}"><i class="fa fa-calendar"></i> Parliamentary Years</a></li>     
        <li class=""><a href="{{ route('sociallink', app()->getLocale()) }}"><i class="fa fa-facebook"></i> Social Links</a></li>     
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>About Assembly</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('about.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> About</a></li>
            <li><a href="{{ route('messages.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Messages</a></li>
            <li><a href="{{ route('workingofassembly.store', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Working of Assembly</a></li>
            <li><a href="{{ route('roleofassembly.store',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Role of Assembly</a></li>
            <li><a href="{{ route('cabinetcomposition.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Cabinet Composition</a></li>
            <li><a href="{{ route('advisor.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i>Manage Advisors</a></li>
            <!-- <li><a href="{{ url('messages') }}"><i class="fa fa-circle-o"></i> Leader of the House</a></li>
            <li><a href="{{ url('messages') }}"><i class="fa fa-circle-o"></i> Leader of the Opposition</a></li> -->
            <li><a href="{{ route('rulesofprocedures.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Rules of Procedures</a></li>
            <li><a href="{{ route('parliamentaryprivileges.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Parliamentary Privileges</a></li>
        
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>About Secretariat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('overview.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Overview</a></li>
            <li><a href="{{ route('organizationalchart.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Organizational Chart</a></li>
            <li><a href="{{ route('directoryofofficers.index') }}"><i class="fa fa-circle-o"></i> Directory of Officers</a></li>
            <li><a href="{{ route('powersfunctions.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Powers & Functions</a></li>
            <li><a href="{{ route('contactlist.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Contact List</a></li>
            <li><a href="{{ route('rules.index') }}"><i class="fa fa-circle-o"></i> Rules</a></li>
            <li><a href="{{ route('thesindhtrans2016.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Sindh Transparency and Right</a></li>
            <li><a href="{{ route('assemblylibrary.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Assembly Library</a></li>        
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('speakers.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Speaker</a></li>    
            <li><a href="{{ route('deputyspeaker.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Deputy Speaker</a></li>    
            <li><a href="{{ route('membersdirectory.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Members' Directory</a></li>    
            <li><a href="{{ route('elections.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Manage By Election</a></li>    
            <li><a href="{{ route('listofmembers.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> List of Members</a></li>    
            <li><a href="{{ route('membersperformancereport.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Members performance report</a></li>    
            <li><a href="{{ route('pastassemblymembers.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Past Assembly Members</a></li>    
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Assembly Business</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <li><a href="{{ route('currentassemblysummary.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Current Assembly Summary</a></li>        
            <li><a href="{{ route('mainsessions.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Sessions</a></li>        
            <li><a href="{{ route('otdsummaryofproceedings.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Order of the day (Agenda)</a></li>        
            <li><a href="{{ route('otdsummaryofproceedings.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Summary of proceedings</a></li>        
            <li><a href="{{ route('otdsummaryofproceedings.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> House Debates</a></li>        
            <li><a href="{{ route('questions.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Questions</a></li>        
            <li><a href="{{ route('resolutionspassed.index') }}"><i class="fa fa-circle-o"></i> Resolutions Passed</a></li>        
            <li><a href="{{ route('callattention.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Call Attention</a></li>        
            <li><a href="{{ route('stagesofbills.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Stages of Bills</a></li>        
            <li><a href="{{ route('bills.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Bills</a></li>        
            <li><a href="{{ route('acts.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Acts</a></li>        
            <li><a href="{{ route('motions.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Motions</a></li>        
            <!-- <li><a href="{{ url('assemblylibrary') }}"><i class="fa fa-circle-o"></i> Performance of Assembly</a></li>         -->
            <li><a href="{{ route('parliamentarycalendar.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Parliamentary Calendar</a></li>    
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span>Committees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('committeesystemdetail.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Committee System </a></li>    
            <li><a href="{{ route('committeerules.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Committee Rules </a></li>    
            <li><a href="{{ route('publicaccountscommitteemember.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> All Committees Members </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> All Committees </a></li>    
            <li><a href="{{ route('standingcommittees.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Standing Committees </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Committees on Rules </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Finance Committee </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Select committee on bills </a></li>    
            <li><a href="{{ route('committeeongovernmentassurance.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Committee on Govt & Assurance </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Library committee </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Business Advisory committee </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Special Committee </a></li>    
            <li><a href="{{ route('reportslaid.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Reports (Laid) </a></li>    
            <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> House Committee </a></li>    
            <!-- <li><a href="{{ route('publicaccountscommittee.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Construction Committee </a></li>  -->

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-camera-retro"></i> <span>Media Center</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
              <!-- START -->
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Notification</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('notifications.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Sessions</a></li>      
                  <li><a href="{{ route('notifications.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Members</a></li>      
                  <li><a href="{{ route('notifications.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Committees</a></li>      
                  <li><a href="{{ route('notifications.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> General</a></li>      
                </ul>
              </li>
              <!-- END -->
            
            <li><a href="{{ route('pressreleases.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Press Releases </a></li>  
            <li><a href="{{ route('pressreleases.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> News and activities </a></li>  
            <li><a href="{{ route('picturegallery.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Picture Gallery </a></li>  
            <li><a href="{{ route('tenders.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Tenders </a></li>  
            <li><a href="{{ route('tenders.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Jobs </a></li>  
            <li><a href="{{ route('glossary.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Glossary </a></li>  
            <!-- <li><a href="{{ url('notifications') }}"><i class="fa fa-circle-o"></i> Useful Links </a></li>   -->
            <li><a href="{{ route('faqs.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> FAQs </a></li>  
            <li><a href="{{ route('webcastlivevideoaudio.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Webcast </a></li>  
            <li><a href="{{ route('videoarchive.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Video Archive </a></li>  
              
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bars"></i> <span>Publications</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('publications.index', app()->getLocale()) }}"><i class="fa fa-circle-o"></i> Publications </a></li>  
            <li><a href="{{ route('publications.index', app()->getLocale())  }}"><i class="fa fa-circle-o"></i> Reports </a></li>  

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-phone-square"></i> <span>Contact Us</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('contactus', app()->getLocale())  }}"><i class="fa fa-circle-o"></i> Contact Us </a></li>  

          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    @yield('content');
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="/">PAS PK</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="{{ url ('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ url ('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url ('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url ('bower_components/raphael/raphael.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url ('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url ('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url ('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url ('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url ('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ url ('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url ('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url ('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url ('dist/js/pages/dashboard.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url ('dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

<script>
$(document).ready(function() {
    $('select').select2();
});
  $(document).ready(function() {
    
  $('.summernote').summernote();

  $('table').DataTable( {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
});

});
</script>
<script>
  $(document).ready(function() {
    var type = '@if(isset($singleRow)){{$singleRow->type}}@endif';
    
    if(type!='text'){
        $('[name="image_pdf_link"]').eq(1).parent('div').hide();
        $('[name="description"]').eq(1).parent('div').hide();
    }else{
      $('[name="image_pdf_link"]').eq(0).parent('div').hide();
      $('[name="description"]').eq(0).parent('div').hide();
    }

    $('[name="type"]').change(function(){
      selected = $('[name="type"]').children('option:selected').val();
      if(selected=='pdf' || selected=='jpg' || selected=='png'){
        $('[name="image_pdf_link"]').eq(1).parent('div').hide()
        $('[name="description"]').eq(1).parent('div').hide()
        $('[name="image_pdf_link"]').eq(0).parent('div').show()
        $('[name="description"]').eq(0).parent('div').show()
      }else{
        $('[name="image_pdf_link"]').eq(1).parent('div').show()
        $('[name="description"]').eq(1).parent('div').show()
        $('[name="image_pdf_link"]').eq(0).parent('div').hide()
        $('[name="description"]').eq(0).parent('div').hide()
      }
    });
    
  });
  
</script>
<script>
    $(document).ready(function(){
        $('.addnewrow').click(function(e){
            e.preventDefault();
              var row = '<tr>';
               row +='<td> <input type="text" name="assemblyquestiontext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="assemblyquestionvalue[]" class="form-control" value="-"> </td>';

               row +='<td> <input type="text" name="privilegemotionstext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="privilegemotionsvalue[]" class="form-control" value="-"> </td>';

               row +='<td> <input type="text" name="adjournmentmotiontext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="adjournmentmotionvalue[]" class="form-control" value="-"> </td>';

               row +='<td> <input type="text" name="privatebillstext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="privatebillsvalue[]" class="form-control" value="-"> </td>';

               row +='<td> <input type="text" name="Resolutionstext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="Resolutionsvalue[]" class="form-control" value="-"> </td>';

               row +='<td> <input type="text" name="motionstext[]" class="form-control" value="-"> </td>';
               row +='<td> <input type="text" name="motionsvalue[]" class="form-control" value="-"> </td>';
               row +='</tr>';
               
              $('.memberperformbody').append(row);
        });

        $('.addqualification').click(function(e){
            e.preventDefault();
              var row = '<div class="row"><div class="col-md-2"> <div class="form-group"><label for="">Qualification </label><select name="qualification[]" class="form-control">    <option value="-">Select Qualification</option><option value="Ph.D">Ph.D</option><option value="MPhil">MPhil</option><option value="LL.M">LL.M.</option><option value="M Pharmacy">M Pharmacy</option><option value="M.Sc.(Hons)">M.Sc.(Hons)</option><option value="M.Com">M.Com</option><option value="M.Sc">M.Sc.</option><option value="MBA">MBA</option><option value="Master in Surgery">Master in Surgery</option><option value="MA">MA</option><option value="MPA">MPA</option><option value="MCIT">MCIT</option><option value="MD">MD</option><option value="ME">ME</option><option value="Shahdat-ul-Almia">Shahdat-ul-Almia</option><option value="MRCP">MRCP</option><option value="MCPS">MCPS</option><option value="FCPS">FCPS</option><option value="FRCP">FRCP</option><option value="FRCS">FRCS</option><option value="MACP">MACP</option><option value="PGD">PGD</option><option value="L.L.B (Hons)">L.L.B (Hons)</option><option value="Diploma in Computer Science">Diploma in Computer Science</option><option value="Advance Diploma in Business Administration">Advance Diploma in Business Administration</option><option value="Diploma in Cardiology">Diploma in Cardiology</option><option value="Diploma in Gyanee">Diploma in Gyanee</option><option value="Certification in Global Financial Markets">Certification in Global Financial Markets</option><option value="Diploma in Labour Laws">Diploma in Labour Laws</option><option value="Diploma in Taxation Laws">Diploma in Taxation Laws</option><option value="B.Com">B.Com</option><option value="L.L.B">L.L.B</option><option value="B.Ed">B.Ed.</option><option value="B.Sc.(Hons)">B.Sc.(Hons)</option><option value="MBBS">MBBS</option><option value="BA">BA</option><option value="BCS">BCS</option><option value="BCIT">BCIT</option><option value="BE">BE</option><option value="B.Sc. (Engr.)">B.Sc. (Engr.)</option><option value="B.B.A">B.B.A</option><option value="B.Sc">B.Sc.</option><option value="BA B.Ed">BA B.Ed.</option><option value="Graduation">Graduation</option><option value="B.B.A. (Hons)">B.B.A. (Hons)</option><option value="B Pharmacy">B Pharmacy</option><option value="Bachelor of Architect">Bachelor of Architect</option><option value="BA (Hons.)">BA (Hons.)</option><option value="Diploma in Business Administration">Diploma in Business Administration</option><option value="Diploma in Interior Design">Diploma in Interior Design</option><option value="Diploma in Physical Education">Diploma in Physical Education</option><option value="D.Com">D.Com.</option><option value="Diploma of Associate Engineering">Diploma of Associate Engineering</option><option value="Senior Cambridge">Senior Cambridge</option><option value="F.Sc">F.Sc.</option><option value="A-Level">A-Level</option><option value="F.A">F.A</option><option value="ICS">ICS</option><option value="Certificate">Certificate</option><option value="O-Level">O-Level</option><option value="Matriculation">Matriculation</option><option value="Tanzeem-ul-Madaras">Tanzeem-ul-Madaras</option><option value="Under Matric">Under Matric</option><option value="Middle">Middle</option><option value="Master of Arts (International Relations)">Master of Arts (International Relations)</option><option value="Barrister of Law">Barrister of Law</option><option value="Army Special Certification of Education">Army Special Certification of Education</option><option value="M.S. (Orthopaedics)">M.S. (Orthopaedics)</option><option value="M.Ed">M.Ed.</option>';
                  row +='</select>';
                        
                  row +='</div></div><div class="col-md-3"><div class="form-group"><label for="">Year of Passing </label>';
                  row +=' <input type="text"  name="yearofpassing[]" value="@if(isset($singleRow)){{$singleRow->yearofpassing}}@else - @endif" class="form-control">';
                  row +='</div></div><div class="col-md-3"><div class="form-group"><label for="">Institute/University</label><input type="text" name="iu[]" value="@if(isset($singleRow)){{$singleRow->iu}}@else - @endif" class="form-control"></div>';
                  row +='</div><div class="col-md-3"><div class="form-group"><label for="">Details</label><input type="text" name="edudetails[]" value="@if(isset($singleRow)){{$singleRow->edudetails}}@else - @endif" class="form-control"> </div>';
                  row +='</div>';
                  row +='<div class="col-md-1"><a href="#" class="btn btn-danger remqualification" style="margin-top: 23px;">-</a></div></div>';
              $('.addqualificationbody').append(row);
        })
        $('.addqualificationbody').delegate('.remqualification','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        })

        // PREVOIUS
        $('.addprevious').click(function(e){
            e.preventDefault();
              
              var row ='<div class="row"><div class="col-md-3"><div class="form-group"><label for="">Previous official positions</label><select name="previousposition[]" class="form-control"><option value="-">Select One..</option><option value="Baitul Maal Committee">Baitul Maal Committee</option><option value="Cattle Market Management Company">Cattle Market Management Company</option><option value="Chief Minister Complaint Cell">Chief Minister Complaint Cell</option><option value="Chief Minister, Punjab">Chief Minister, Punjab</option><option value="Corporation, Gujranwala">Corporation, Gujranwala</option><option value="Crime Control Committe">Crime Control Committe</option><option value="District Council">District Council</option><option value="District Education Advisory Committee">District Education Advisory Committee</option><option value="District Khidmat Committee">District Khidmat Committee</option><option value="District Nazim, Shakargarh">District Nazim, Shakargarh</option><option value="District Public Safety Police Complaint Commission">District Public Safety Police Complaint Commission</option><option value="Divisional Darbar">Divisional Darbar</option><option value="Education Department">Education Department</option><option value="Federal Government">Federal Government</option><option value="Governer of the Punjab">Governer of the Punjab</option><option value="Govt. of Sindh">Govt. of Sindh</option><option value="Govt. of the Punjab">Govt. of the Punjab</option><option value="Health Department">Health Department</option><option value="High Court">High Court</option><option value="Home Department">Home Department</option><option value="Law Department">Law Department</option><option value="Local Government">Local Government</option><option value="Majlis-e-Shoora">Majlis-e-Shoora</option><option value="Market Committee">Market Committee</option><option value="Markiz Council">Markiz Council</option><option value="Metropolitian Corporation, Lahore">Metropolitian Corporation, Lahore</option><option value="Multan Cess Committee">Multan Cess Committee</option><option value="Multan Development Authority">Multan Development Authority</option><option value="Multan Waste Management Company">Multan Waste Management Company</option><option value="Municipal Committee">Municipal Committee</option><option value="Municipal Corporation">Municipal Corporation</option><option value="National Assembly of Pakistan">National Assembly of Pakistan</option><option value="Pakistan Air Force">Pakistan Air Force</option><option value="Pakistan Army">Pakistan Army</option><option value="Pakistan Cricket Board">Pakistan Cricket Board</option><option value="Pakistan International Airline">Pakistan International Airline</option><option value="Police Department">Police Department</option><option value="Provincial Assembly of Sindh">Provincial Assembly of Sindh</option><option value="Provincial Assembly of the Punjab">Provincial Assembly of the Punjab</option><option value="Provincial Council of the Punjab">Provincial Council of the Punjab</option><option value="Punjab Heritage Fund">Punjab Heritage Fund </option><option value="Punjab Legislative Council">Punjab Legislative Council</option><option value="Punjab Norcotics Committee">Punjab Norcotics Committee</option><option value="Punjab Privatization Commission">Punjab Privatization Commission</option><option value="Punjab Procurement Regulatory Authority">Punjab Procurement Regulatory Authority</option><option value="Quaid-e-Azam Solar Park Company">Quaid-e-Azam Solar Park Company</option><option value="Senate of Pakistan">Senate of Pakistan</option><option value="Social Action Board">Social Action Board</option><option value="State Bank of Pakistan">State Bank of Pakistan</option><option value="Tehsil Council">Tehsil Council</option><option value="Tehsil Nazim, Shakargarh">Tehsil Nazim, Shakargarh</option><option value="Town Committee">Town Committee</option><option value="Water and Sanitation Agency">Water and Sanitation Agency</option><option value="West Pakistan Assembly">West Pakistan Assembly</option><option value="Women Crises Center, Vehari">Women Crises Center, Vehari</option></select>';
              row +='</div></div><div class="col-md-3"><div class="form-group">Govt. Body</div><input type="text" class="form-control" value="-" name="govtbody[]"></div>';
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger remprevious" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addpreviousbody').append(row);
        })
        $('.addpreviousbody').delegate('.remprevious','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        });

        // add political
        $('.addpolitical').click(function(e){
            e.preventDefault();
              var row = '<div class="row">';
              row  +=$(this).parent('p').next('.row').html();
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger rempolitical" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addpoliticalbody').append(row);
        })
        $('.addpoliticalbody').delegate('.rempolitical','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        });

        // add Visits
        $('.addvisits').click(function(e){
            e.preventDefault();
              var row = '<div class="row">';
              row  +=$(this).parent('p').next('.row').html();
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger remvisits" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addvisitsbody').append(row);
        })
        $('.addvisitsbody').delegate('.remvisits','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        });

        // add Event Type
        $('.addevent').click(function(e){
            e.preventDefault();
              var row = '<div class="row">';
              row  +=$(this).parent('p').next('.row').html();
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger remevent" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addeventbody').append(row);
        })
        $('.addeventbody').delegate('.remevent','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        });

         // add Event Type
         $('.addmoc').click(function(e){
            e.preventDefault();
              var row = '<div class="row">';
              row  +=$(this).parent('p').next('.row').html();
              row +='</div><div class="row">';
              row  +=$(this).parent('p').next().next('.row').html();
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger remmoc" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addmocbody').append(row);
        })
        $('.addmocbody').delegate('.remmoc','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent().prev('.row').remove();
          $(this).parent().parent('.row').remove();
        });

        // add Relatives in Assemblies
        $('.addrelative').click(function(e){
            e.preventDefault();
              var row = '<div class="row">';
              row  +=$(this).parent('p').next('.row').html();
              row +='<div class="col-md-1"><a href="#" class="btn btn-danger remrelative" style="margin-top: 23px;">-</a></div>';
              row +='</div>';

              // select2-hidden-accessible
              $('.addrelativebody').append(row);
        })
        $('.addrelativebody').delegate('.remrelative','click',function(e){
          e.preventDefault(); 
          $(this).parent().parent('.row').remove();
        })

        $('.pagetype').change(function(){
          var page = $(this).children('option:selected').val();
         
          if(page == 'News and Activities'){
            $('.frontimage').show();
          }else{
            console.log(page);
            $('.frontimage').hide();
          }

        })
    })
</script>

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Sep 2020 15:17:28 GMT -->
</html>

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">Add New Assembly Tenure</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Assemly Name:</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Date From:</label>
                    <input type="date" name="" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                        <label for="">Date  To:</label>
                        <input type="date" name="" class="form-control">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save & Continue</button>
        </div>
      </div>
    </div>
  </form>
</div>