<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--<meta name="description" content="">--}}
	  <meta name="description" content="Want to Conduct exams Online.We offer the best platform to host your exams online. It's Mobile-friendly interface will help you conduct exams in seconds.">
	  <meta name="keywords" content="online exams,conduct exam online,host exam online,exam builder,best platform to host exams,smrtbook,smartbook,Smart,smrt,book,paper,12th,11th, practice paper">
    <meta name="author" content="SmrtBook.in">
	  <link rel="icon" href="home/fav-icon.png" type="image/x-icon" />
    {{--<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}

    <title>Smrtbook.in | Online Examination System</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
    <style type="text/css">
    	.form-login{
    		max-width: 400px;
    	}
    </style>
	  <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-120242667-1');
	  </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="/student/register" method="POST">
		      	 {!! csrf_field() !!}
		        <h2 class="form-login-heading">Register | Student Account</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="name" placeholder="Your Name" autofocus required >
		            <br>
		            <input type="number" min="1000000000" max="9999999999" class="form-control" name="phone" required placeholder="Mobile No">
		            <br>
		            <input type="email" class="form-control" name="emailid" required placeholder="Email ID">
		            <br>

		            <input type="date" class="form-control" name="dob" required placeholder="Date Of Birth">
		            <br>
		            <select type="text" class="form-control" name="class">
						<option value="">Select your Class</option>
						<option value="11">9th Class</option>
						<option value="11">10th Class</option>
						<option value="11">11th Class</option>
		            	<option value="12">12th Class</option>
		            	<option value="13">13th Class</option>
		            	<option value="other">Other</option>
		            </select>
		            <br>
					
					<select type="text" class="form-control" name="coaching">
		            	<option value="">Select Your Coaching Institute</option>
						@foreach($coaching as $coach)
							<option value="{{$coach->user_name}}">{{$coach->coachingName}}</option>
						@endforeach

		            	<option value="other">Other</option>
		            </select>
		            <br>


					<select type="text" class="form-control" name="location">
						<option value="mumbai">Select Your Location</option>
{{--						@foreach($coaching as $coach)--}}
							<option value="mumbai">Mumbai</option>
							<option value="delhi">Delhi</option>
							<option value="pune">Pune</option>
						{{--@endforeach--}}
						<option value="other">Other</option>
					</select>
					<br>



					

		            <!-- <input type="text" class="form-control" name="username" value="abhinav" autofocus required > -->
		            <!-- <br> -->
		            <!-- <input type="password" class="form-control" value="abhinav" name="password" required> -->
		            <label class="checkbox">
		                <!-- <span class="pull-right"> -->
		                    <!-- <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a> -->
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Proceed </button>
		            {{--<hr>--}}
		            
		            <!-- <div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div> -->
		            <div class="registration">
		                Already have an account?<br/>
		                <a class="" href="/student/login">
		                    Login Now
		                </a>
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
    <script type="text/javascript" src="/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("/home/login_bg.jpg", {speed: 500});
    </script>

  </body>
</html>
