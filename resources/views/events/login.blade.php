<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta name="description" content="Want to Conduct exams Online.We offer the best platform to host your exams online. It's Mobile-friendly interface will help you conduct exams in seconds.">
	  <meta name="keywords" content="online exams,conduct exam online,host exam online,exam builder,best platform to host exams,smrtbook,smartbook,Smart,smrt,book,paper,12th,11th, practice paper">
    {{--<meta name="description" content="">--}}
    <meta name="author" content="SmrtBook">
	  <link rel="icon" href="home/fav-icon.png" type="image/x-icon" />
    {{--<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}
    <title>Smrtbook.in | Online Examination System</title>
    <!-- Bootstrap core CSS -->
    {{--<link href="/assets/css/bootstrap.css" rel="stylesheet">--}}
    <!--external css-->
    {{--<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />--}}
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
      {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
    {{--<![endif]-->--}}
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">

			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			
		      <form class="form-login" action="/student/dashboard" method="POST">
		      	 {!! csrf_field() !!}
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Username or Registered email id" autofocus required >
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password Here">
		            <label class="checkbox">
		                <span class="pull-right">
		                     {{--<a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>--}}
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		            <!-- <div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div> -->
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="/student/register">
		                    Create a student account
		                </a>
		            </div>
					<div class="registration">
						Or
						<a href="/">Back to Home</a>
					</div>

		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("/home/login_bg.jpg", {speed: 500});
    </script>


  </body>
</html>
