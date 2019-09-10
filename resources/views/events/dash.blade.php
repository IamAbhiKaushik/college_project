<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name=theme-color content="#efbcdf">
    {{--<meta name="description" content="">--}}
    <meta name="author" content="SmrtBook">
      <link rel="icon" href="home/fav-icon.png" type="image/x-icon" />
    {{--<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}

    <title>Student Dashboard </title>
      <!-- <title >Smrtbook.in | Online Examination System for JEE Advanced | JEE Mains</title> -->
      <meta name="description" content="Want an Online Examination System .We offer the best platform to host Online Exams. The online exam application is Mobile-friendly and will help you conduct exams in seconds.">
      <meta name="keywords" content="Online Examination System ,online exams,online exam demo,online exam software,online exam builder,
    online exam test,conduct exam online,host exam online,exam builder,best platform to host exams,smrtbook,smartbook,Smart,smrt,book,paper,12th,11th, practice paper">
    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      {{--<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />--}}
    <link rel="stylesheet" type="text/css" href="/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lineicons/style.css">
    
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-120242667-1');
      </script>

      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
      <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-81222017-1');</script>

      <style>
      body{
        /*background: linear-gradient(135deg, rgba(215,230,255,1) 0%, rgba(243,219,246,1) 50%, rgba(240,220,247,1) 55%, rgba(217,227,255,1) 100%);*/
            background-attachment: fixed;
      }

#container:before {
    content: "";
    right: 0;
    bottom: 0;
    position: fixed;
    width: 467px;
    height: 610px;
    background: url('/home/right_bottom.png') no-repeat left top;
    z-index: -1;
}

#container:after {
    content: "";
    left: 0;
    bottom: 0;
    position: fixed;
    width: 472px;
    height: 354px;
    background: url('/home/left_bottom.png') no-repeat left top;
    z-index: -1;
}




          .bg-theme{background-color: #424a5d;}
          .cardE{
              /*border: 1px solid #4c5f99;*/
              border-radius: 10px;
              cursor: pointer;
              -webkit-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);
              -moz-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);
              box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);
              /*box-shadow: 5px 5px 25px 0 #b0002026;*/
               margin: 10px;padding: 10px 20px;
               background: #fff url('https://uixninja.github.io/pehia//img/gold.png') no-repeat left bottom;
          }
          @media (max-width: 768px) {
              .cardE{
                  width: 80%;
                  margin-left: 10%;
                  margin-left: 10%;
              }
          }

          .cardE:hover{
              -webkit-box-shadow: 0px 5px 15px 0px rgba(118, 88, 198, 0.1);
              -moz-box-shadow: 0px 5px 15px 0px rgba(118, 88, 198, 0.1);
              box-shadow: 0px 5px 15px 0px rgba(118, 88, 198, 0.1);
              /*border: 2px solid #B00020;*/
              /*box-shadow: none;*/
              /*padding-bottom: 8px;*/
          }
          .btnE{
              text-align: center;padding: 5px;padding-left: 10px;padding-right:10px;border: 1px solid #4c5f99;margin: 5px;background: #4c5f99;
              border-radius: 4px;box-shadow: 2px 4px 8px 0 rgba(46,61,73,.2);color: white;
              font-weight: 600;
          }
          .btnE:hover{
              background: white;color: #4c5f99;box-shadow: none;
          }
          .header{
          background: transparent;
          border-bottom: none;
          }
      </style>

    {{--<script src="/assets/js/chart-master/Chart.js"></script>--}}
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    {{--<!--[if lt IE 9]>--}}
      <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
      {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
    {{--<![endif]-->--}}
  </head>

  <body>

  <section id="container">
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">

              {{--<div class="sidebar-toggle-box" style="color: #4c5f99;">--}}
                  {{--<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>--}}
              {{--</div>--}}

          <span id="hamburger-lap" style="font-size:24px;cursor:pointer;float: left;margin-top: 12px;
        padding-right: 15px;color: #4c5f99;" onclick="openNav()">&#9776;</span>

          <span id="hamburger-mobi" style="font-size:24px;cursor:pointer;float: left;margin-top: 12px;
            padding-right: 15px;color: #4c5f99;" onclick="openNavMobi()">&#9776;</span>


            <a href="/student/dashboard" class="logo" style="color: #4c5f99">
                <b>{{$data->name}} | {{$data->coachingName}}</b></a>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">

                    {{--@if($data->coaching == 'pranjal696' and $data->payment_status == '0')--}}
                        {{--<li><a class="logout" style="color: #4c5f99;--}}
    {{--background: none;--}}
    {{--font-size: 18px;--}}
    {{--border: none !IMPORTANT;--}}
    {{--padding: initial;" href="/payment">Pay To Activate</a></li>--}}
                    {{--@endif--}}

                    {{--<li><a class="logout" style="color: #4c5f99;--}}
    {{--background: none;--}}
    {{--font-size: 18px;--}}
    {{--border: none !IMPORTANT;--}}
    {{--padding: initial;" href="/student/logout">Logout</a></li>--}}


            	</ul>
            </div>
        </header>


      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->


      <div id="mySidenav" class="sidenav" style="background: white">
          <div id="sidebar"  class="nav-collapse ">
          <ul class="sidebar-menu" id="nav-accordion">
              <p class="centered"><a href="#">
                      <img src="https://png.icons8.com/nolan/100/f1c40f/user.png">
                  </a></p>
              <h5 class="centered" title="Your SmrtBook Username" style="color: #231C69;">Username :{{$data->username}}</h5>
              <h6 class="centered" title="CurrentBatch" style="color: #231C69"><i>{{$data->coaching_batch}}</i></h6>
              @yield('sidebar')
          </ul>
          </div>
      </div>

      <div id="sidenav_Mobi" class="sidenav" style="overflow: auto">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <ul class="sidebar-menu" id="nav-accordion">
              <p class="centered"><a href="#">
                      <img src="https://png.icons8.com/nolan/100/f1c40f/user.png">
                  </a></p>
              <h5 class="centered" title="Your SmrtBook Username" style="color: #4c5f99;">Username :{{$data->username}}</h5>
              <h6 class="centered" title="CurrentBatch" style="color: #4c5f99"><i>{{$data->coaching_batch}}</i></h6>
              @yield('sidebar')
          </ul>
      </div>



      {{--<aside style="background: white">--}}
          {{--<div id="sidebar"  class="nav-collapse ">--}}
              {{--<ul class="sidebar-menu" id="nav-accordion">--}}
              	  {{--<p class="centered"><a href="#">--}}
                          {{--<img src="https://png.icons8.com/nolan/100/f1c40f/user.png">--}}
                      {{--</a></p>--}}
                  {{--<h5 class="centered" title="Your SmrtBook Username" style="color: #231C69;">Username :{{$data->username}}</h5>--}}
                  {{--<h6 class="centered" title="CurrentBatch" style="color: #231C69"><i>{{$data->coaching_batch}}</i></h6>--}}
                  {{--@yield('sidebar')--}}

              {{--</ul>--}}
          {{--</div>--}}
      {{--</aside>--}}



      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->


      <section id="main-content" style="background:transparent;">
        @yield('mainContent')


          <p style="text-align: center;width: 100%;color: #4c5f99;">
              Copyright © smrtbook 2018
          </p>

      </section>
      <!--main content end-->
      <!--footer start-->
      <!-- <footer class="site-footer">
          <div class="text-center">
              K Productions
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer> -->
      <!--footer end-->
  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    <!-- <script src="assets/js/jquery-1.8.3.min.js"></script> -->
    <script type="text/javascript">
    var domain = window.location.hostname;

    divs = document.getElementsByClassName( 'host');
    [].slice.call( divs ).forEach(function ( div ) {
    div.innerHTML = domain;
    });
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>--}}
  {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    {{--<script src="assets/js/bootstrap.min.js"></script>--}}
    {{--<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>--}}
    {{--<script src="/assets/js/jquery.scrollTo.min.js"></script>--}}
    <script src="/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    {{--<script src="/assets/js/jquery.sparkline.js"></script>--}}
    <!--common script for all pages-->
    <script src="/assets/js/common-scripts.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--<script type="text/javascript" src="/assets/js/gritter/js/jquery.gritter.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/js/gritter-conf.js"></script>--}}

    <!--script for this page-->
  @yield('scripts')

  <script>
      function openNav() {
          if (document.getElementById("sidebar").style.width == "210px") {
              document.getElementById("sidebar").style.width = "0";
              document.getElementById("main-content").style.marginLeft= "0";
          }
          else {
              document.getElementById("sidebar").style.width = "210px";
              document.getElementById("main-content").style.marginLeft = "230px";
          }
      }

      function openNavMobi() {
          // if (document.getElementById("sidebar").style.width == "210px") {
          document.getElementById("sidenav_Mobi").style.marginLeft= "0";
          // document.getElementById("main-content").style.marginLeft= "0";
          // }
          // else {
          //     document.getElementById("sidebar").style.width = "210px";
          //     document.getElementById("main-content").style.marginLeft = "230px";
          // }
      }
      function closeNav() {
          document.getElementById('sidenav_Mobi').style.marginLeft = '-100%';
      }


      // credit: http://www.javascriptkit.com/javatutors/touchevents2.shtml
      function swipedetect(el, callback){
          var touchsurface = el,
              swipedir,
              startX,
              startY,
              distX,
              distY,
              threshold = 150, //required min distance traveled to be considered swipe
              restraint = 100, // maximum distance allowed at the same time in perpendicular direction
              allowedTime = 300, // maximum time allowed to travel that distance
              elapsedTime,
              startTime,
              handleswipe = callback || function(swipedir){}
          touchsurface.addEventListener('touchstart', function(e){
              var touchobj = e.changedTouches[0]
              swipedir = 'none'
              dist = 0
              startX = touchobj.pageX
              startY = touchobj.pageY
              startTime = new Date().getTime() // record time when finger first makes contact with surface
              // e.preventDefault()
          }, false)

          touchsurface.addEventListener('touchmove', function(e){
              // e.preventDefault() // prevent scrolling when inside DIV
          }, false)

          touchsurface.addEventListener('touchend', function(e){
              var touchobj = e.changedTouches[0]
              distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
              distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
              elapsedTime = new Date().getTime() - startTime // get time elapsed
              if (elapsedTime <= allowedTime){ // first condition for awipe met
                  if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
                      swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
                  }
                  else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
                      swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
                  }
              }
              handleswipe(swipedir)
              // e.preventDefault()
          }, false)
      }
      //USAGE:
      var el = document.getElementById('main-content');
      var el2 = document.getElementById('sidenav_Mobi');
      swipedetect(el, function(swipedir){
          // console.log(el);
          // swipedir contains either "none", "left", "right", "top", or "down"
          if (swipedir == 'right'){
              openNavMobi();
          }
          // else {
              // swipedir.preventDefault();
          // }
          // el.innerHTML = 'Swiped <span style="color:yellow">' + swipedir +'</span>';
      });

      swipedetect(el2, function(swipedir){
          // console.log(el);
          // swipedir contains either "none", "left", "right", "top", or "down"
          if (swipedir == 'left'){
              closeNav();
          }
          // else  swipedir.preventDefault();
          // el.innerHTML = 'Swiped <span style="color:yellow">' + swipedir +'</span>';
      });

  </script>

  </body>
</html>
