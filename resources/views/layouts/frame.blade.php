 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="home/fav-icon.png" type="image/x-icon" />
  <meta name="description" content="">
  <meta name="author" content="">
  <title>{{Auth::user()->coachingName}}</title>
  <!-- Bootstrap core CSS-->
    <link rel="icon" href="/home/fav-icon.png" type="image/x-icon" />
    @yield('header')
  <link href="{{URL::asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{URL::asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{URL::asset('css/sb-admin.css')}}" rel="stylesheet">

    <style>
        .btnE{
            text-align: center;padding: 5px;padding-left: 10px;padding-right:10px;border: 1px solid #4c5f99;margin: 5px;background: #4c5f99;
            border-radius: 4px;box-shadow: 2px 4px 8px 0 rgba(46,61,73,.2);color: white;
            font-weight: 600;
        }
        .btnE:hover{
            background: white;color: #4c5f99;box-shadow: none;
        }
        .btnB{
            background: #02b3e4;
            /*padding-left: 20px;*/
            /*padding-right: 20px;*/
            color: white;
            color: #ffffff;
            border: .125rem solid transparent;
            -webkit-box-shadow: 8px 10px 20px 0 rgba(46,61,73,.15);
            box-shadow: 8px 10px 20px 0 rgba(46,61,73,.15);
            /*box-shadow: 8px 10px 20px 0 rgba(46,61,73,.15);*/
            border-radius: .25rem;
            margin-left: 20px;
        }
        .btnB:hover{
            background: #02b3e49c;
            -webkit-box-shadow: 2px 4px 8px 0 rgba(46,61,73,.2);
            box-shadow: 2px 4px 8px 0 rgba(46,61,73,.2);
        }
        .bg-dark {
            background-color: #ffffff!important;
        }
        a:hover{
            text-decoration: none;
            color: #ff5483;
        }
         .card-header{
             background-color: rgba(2, 179, 228, 0.58);
             border-bottom: 1px solid rgb(255, 255, 255);
             color: white;
         }
        .card{border: 1px solid rgb(255, 255, 255);}

    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-120242667-1');
    </script>
    
 <!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top" >
  <!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="background-color: white!important;
    border: 1px solid white;box-shadow: 0 1px 20px 0 rgba(46,61,73,.2);padding-top: 0.8rem;padding-bottom: 0.8rem;">
    <a class="navbar-brand" href="{{ url('/admin_views/dashboard') }}" style="color: #02b3e4!important;">{{Auth::user()->coachingName}}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span  style="color:#02b3e4;">   <i class="fa fa-bars"></i> </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive" >
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="overflow:auto;">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ url('/admin_views/dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Test">
          <a class="nav-link" href="/admin_views/create_test">
            <i class="fa fa-fw fa-plus"></i>
            <span class="nav-link-text">Create Exam</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Test">
          <a class="nav-link" href="/admin_views/see_all">
            <i class="fa fa-fw fa-sliders"></i>
            <span class="nav-link-text">Manage Exam</span>
          </a>
        </li>



          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Students">
              <a class="nav-link" href="/admin_views/manage_students">
                  <i class="fa fa-fw fa-wrench"></i>
                  <span class="nav-link-text">Manage Students</span>
              </a>
          </li>

          {{--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Merge Result">--}}
              {{--<a class="nav-link" href="/admin_views/merge">--}}
                  {{--<i class="fa fa-fw fa-code"></i>--}}
                  {{--<span class="nav-link-text">Merge</span>--}}
              {{--</a>--}}
          {{--</li>--}}
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Public Exam">
              <a class="nav-link" href="/admin_views/show_public">
                  <i class="fa fa-fw fa-pencil"></i>
                  <span class="nav-link-text">Create Public Exam</span>
              </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Guidelines">
              <a class="nav-link" href="/admin_views/rule_book">
                  <i class="fa fa-fw fa-bars"></i>
                  <span class="nav-link-text">GuideLines</span>
              </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
              <a class="nav-link" href="/admin_views/view_change_info">
                  <i class="fa fa-fw fa-user-o"></i>
                  <span class="nav-link-text">Update Info</span>
              </a>
          </li>
<!--         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li> -->
<!--         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Components</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="">Navbar</a>
            </li>
            <li>
              <a href="">Cards</a>
            </li>
          </ul>
        </li> -->
       <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Example Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="login.html">Login Page</a>
            </li>
            <li>
              <a href="register.html">Registration Page</a>
            </li>
            <li>
              <a href="forgot-password.html">Forgot Password Page</a>
            </li>
            <li>
              <a href="blank.html">Blank Page</a>
            </li>
          </ul>
        </li> 
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li> -->
<!--         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li> -->
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler" style="background: #02b3e4 !important;border-bottom-right-radius: 4px;">
            <i class="fa fa-fw fa-angle-left" style="color: white;"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li> -->
        <li class="nav-item dropdown">
          {{--<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #02b3e4!important">--}}
            {{--<i class="fa fa-fw fa-bell" style="color: #02b3e4"></i>--}}
            {{--<span class="d-lg-none">Alerts--}}
              {{--<span class="badge badge-pill badge-warning">6 New</span>--}}
            {{--</span>--}}
            {{--<span class="indicator text-warning d-none d-lg-block">--}}
              {{--<i class="fa fa-fw fa-circle" style="color:#02b3e4;"></i>--}}
            {{--</span>--}}
          {{--</a>--}}
          <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="left:auto;right: 1px">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>


              <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Notifications</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">All your Admin related notifications will appear here.</div>
            </a>
            <div class="dropdown-divider"></div>

            {{--<a class="dropdown-item" href="#">--}}
              {{--<span class="text-danger">--}}
                {{--<strong>--}}
                  {{--<i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>--}}
              {{--</span>--}}
              {{--<span class="small float-right text-muted">11:21 AM</span>--}}
              {{--<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>--}}
            {{--</a>--}}
            {{--<div class="dropdown-divider"></div>--}}
            {{--<a class="dropdown-item" href="#">--}}
              {{--<span class="text-success">--}}
                {{--<strong>--}}
                  {{--<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>--}}
              {{--</span>--}}
              {{--<span class="small float-right text-muted">11:21 AM</span>--}}
              {{--<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>--}}
            {{--</a>--}}
            {{--<div class="dropdown-divider"></div>--}}
            {{--<a class="dropdown-item small" href="#">View all alerts</a>--}}
          </div>
        </li>  
  <li class="nav-item">
         
          <a class="nav-link" style="color: #02b3e4">
            <i class="fa fa-fw fa-user-o"></i>{{Auth::user()->user_name}}</a>
           
        </li> 
        <li class="nav-item" style="color: #02b3e4">
          <a class="nav-link btnB" data-toggle="modal" data-target="#exampleModal" style="padding-right: 1.2rem;
          color: white;padding-left: 1.2rem;">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
           <ol class="breadcrumb" style="background: none">
        <li class="breadcrumb-item">
          <a href="{{ url('/admin_views/dashboard') }}" style="color: #02b3e4">Dashboard</a>
        </li>
     @yield('inside')
        {{--<hr>--}}
   </div>
 </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © smrtbook 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                                         
          </div>
        </div>
      </div>
    </div>

   <script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{URL::asset('vendor/chart.js/Chart.js')}}"></script>
    <script src="{{URL::asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{URL::asset('js/sb-admin-datatables.js')}}"></script>
    {{--<script src="{{URL::asset('js/sb-admin-charts.js')}}"></script>--}}
  <script src="{{URL::asset('js/echarts.min.js')}}"></script>
  <script src="{{URL::asset('js/co-chart.js')}}"></script>

     <script>
    $('#toggleNavPosition').click(function() {
      $('body').toggleClass('fixed-nav');
      $('nav').toggleClass('fixed-top static-top');
    });

    </script>
    <!-- Toggle between dark and light navbar-->
    <script>
    $('#toggleNavColor').click(function() {
      $('nav').toggleClass('navbar-dark navbar-light');
      $('nav').toggleClass('bg-dark bg-light');
      $('body').toggleClass('bg-dark bg-light');
    });

    </script>
 @yield('scripts')
</body>

</html>
