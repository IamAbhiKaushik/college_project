<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Want to Conduct exams Online.We offer the best platform to host your exams online. It's Mobile-friendly interface will help you conduct exams in seconds.">
    <meta name="keywords" content="online exams,conduct exam online,host exam online,exam builder,best platform to host exams,smrtbook,smartbook,Smart,smrt,book,paper,12th,11th, practice paper">
    <meta name="author" content="SmrtBook">
    <link rel="icon" href="/home/fav-icon.png" type="image/x-icon" />
    <title class="host">Smrtbook.in | Online Examination System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
{{--<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->--}}
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">--}}
    {{--<!--===============================================================================================-->--}}
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome.min.css">
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/css/util.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-120242667-1');
    </script>
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">



    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="/img/img-01.png" alt="SmrtBook Login">
            </div>

            {{--<form class="login100-form validate-form">--}}
            <form class="login100-form validate-form" action="/student/register" method="POST">
                {!! csrf_field() !!}
                <span class="login100-form-title">
						Student Register
					</span>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="name" placeholder="Your Name" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="number" min="1000000000" max="9999999999" name="phone" required placeholder="Mobile No">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="emailid" required placeholder="Email ID">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <select type="text" class="input100" name="coaching">
                        <option value="">Select Coaching Institute</option>
                        @foreach($coaching as $coach)
                            <option value="{{$coach->user_name}}">{{$coach->coachingName}}</option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>
                    {{--<input class="input100" type="email" name="emailid" required placeholder="Email ID">--}}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-university" aria-hidden="true"></i>
						</span>
                </div>

                {{----}}
                {{--<select type="text" class="form-control" name="coaching">--}}
                    {{--<option value="">Select Your Coaching Institute</option>--}}
                    {{--@foreach($coaching as $coach)--}}
                        {{--<option value="{{$coach->user_name}}">{{$coach->coachingName}}</option>--}}
                    {{--@endforeach--}}

                    {{--<option value="other">Other</option>--}}
                {{--</select>--}}
                {{----}}






                {{--<div class="wrap-input100 validate-input" data-validate = "Password is required">--}}
                    {{--<input class="input100" type="password" name="password" placeholder="Password" required>--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-lock" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Register Now
                    </button>
                </div>
                <span class="txt2">
                        Your username and password will be sent to above email ID
                    </span>

                {{--<div class="text-center p-t-12">--}}
                {{--<span class="txt1">--}}
                {{--Forgot--}}
                {{--</span>--}}
                {{--<a class="txt2" href="#">--}}
                {{--Username / Password?--}}
                {{--</a>--}}
                {{--</div>--}}

                <div class="text-center p-t-136">
                    <a class="txt2" href="/student/login">
                        Already Registered with <b class="host">..</b> | Login Now
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    var domain = window.location.hostname;

    divs = document.getElementsByClassName( 'host');
    [].slice.call( divs ).forEach(function ( div ) {
    div.innerHTML = domain;
    });
</script>

<!--===============================================================================================-->
{{--<script src="vendor/jquery/jquery.min.js"></script>--}}
<!--===============================================================================================-->
{{--<script src="vendor/bootstrap/js/popper.js"></script>--}}
{{--<script src="vendor/bootstrap/js/bootstrap.min.js"></script>--}}
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/assets/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/assets/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
{{--<script src="/js/main.js"></script>--}}

</body>
</html>