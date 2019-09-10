<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Want to Conduct exams Online.We offer the best platform to host your exams online. It's Mobile-friendly interface will help you conduct exams in seconds.">
    <meta name="keywords" content="online exams,conduct exam online,host exam online,exam builder,best platform to host exams,smrtbook,smartbook,Smart,smrt,book,paper,12th,11th, practice paper">
    <meta name="author" content="SmrtBook">
    <link rel="icon" href="/home/fav-icon.png" type="image/x-icon" />
    <title>Smrtbook.in | Online Examination System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-120242667-1');
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-81222017-1');</script>


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
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">


    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                @if(empty($coaching->logo))
                    <img src="/img/tf_logo.png" alt="SmrtBook Login">
                @else
                    <img src="/logo/{{$coaching->logo}}" alt="SmrtBook Login">
                @endif
                <span class="login100-form-title">
						{{$coaching->coachingName}}
					</span>
            </div>

            {{--<form class="login100-form validate-form">--}}
            <form class="login100-form validate-form" action="/student/techfest" method="POST" id="loginForm">
                {!! csrf_field() !!}
                <span class="login100-form-title">
						Student Register
					</span>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="wrap-input100 validate-input" data-validate = "Valid Name is required">
                    <input class="input100" type="text" name="name" placeholder="Your Name" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "A valid mobile no is required">
                    <input class="input100" type="number" min="1000000000" max="9999999999" name="phone" required placeholder="Mobile No">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
                </div>

                <p style="font-size: 80%;">A <b>Gmail ID </b>is recommended </p>
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="emailid" required placeholder="Email ID" id="emailid">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <p style="font-size: 80%;" id="info_up">Write a valid Email ID, a confirmation mail will be sent on the same</p>
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="re_emailid" required placeholder="Re-type Email ID" id="re_emailid">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>


                {{--NSO ROLL NO--}}
                <p style="font-size: 80%;">NSO Roll no Format: <b>AN0006-08-A-001</b></p>
                <div class="wrap-input100 validate-input" data-validate = "Valid Way: AN0006-08-A-001">
                    <input class="input100" type="text" id="rollno" name="rollno" required placeholder="Your NSO Roll No(Format: AN0006-08-A-001)" style="text-transform:uppercase">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-id-card" aria-hidden="true"></i>
						</span>
                </div>

                {{--#class--}}
                {{--<div class="wrap-input100 validate-input" data-validate = "Select one the below">--}}
                    {{--<select type="text" class="input100" name="class">--}}
                        {{--<option value="">Your Class</option>--}}
                            {{--<option value="8">8th Class</option>--}}
                            {{--<option value="9">9th Class</option>--}}
                            {{--<option value="10">10th Class</option>--}}
                    {{--</select>--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
                        {{--<i class="fa fa-id-card" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}



                <div class="wrap-input100 validate-input" data-validate = "Select one of the exam Timing">

                    <select type="text" class="input100" name="batch">
                        <option value="">Select Your NSO Exam Date</option>
                        @foreach($batches as $batch)
                            <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
                        @endforeach
                    </select>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
						</span>
                </div>
                {{--rollno--}}

                {{--PIN CODE--}}
                {{--<div class="wrap-input100 validate-input" data-validate = "Valid Pin Code is required">--}}
                    {{--<input class="input100" type="text" name="pincode" required placeholder="Pin Code">--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-envelope" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}

                {{--School --}}
                {{--<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">--}}
                    {{--<input class="input100" type="text" name="school" required placeholder="Your School Name">--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-university" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}

                {{--School email--}}
                {{--<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">--}}
                    {{--<input class="input100" type="email" name="school_email" placeholder="School's email ID">--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-university" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}

                {{--School mobile--}}
                {{--<div class="wrap-input100 validate-input" data-validate = "Valid Mobile is required">--}}
                    {{--<input class="input100" type="text" name="school_mobile" placeholder="Your School's Contact info">--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-university" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}



                {{--<div class="wrap-input100 validate-input" data-validate = "Gender">--}}
                    {{--<select type="text" class="input100" name="gender" required>--}}
                        {{--<option value="">Gender</option>--}}
                            {{--<option value="M">Male</option>--}}
                            {{--<option value="F">Female</option>--}}
                    {{--</select>--}}
                    {{--<span class="focus-input100"></span>--}}
                    {{--<span class="symbol-input100">--}}
							{{--<i class="fa fa-university" aria-hidden="true"></i>--}}
						{{--</span>--}}
                {{--</div>--}}



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

                <div class="text-center p-t-16">
                    <a class="txt2" href="/student/login">
                        Already Registered | Login Now
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




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
    // $("#re_emailid").keyup(function() {
    //     var $this = $(this);
    //     var input = document.getElementById('re_emailid').innerHTML;
    //     var pre = document.getElementById("emailid").innerHTML;
    //     if (input ==pre){
    //         document.getElementById('info_up').innerHTML = 'Email ID Matching, Please proceed,';
    //         document.getElementById('info_up').style.color = 'green';
    //     }
    //     else{
    //         document.getElementById('info_up').innerHTML = 'Email ID not Matching';
    //         document.getElementById('info_up').style.color = 'red';
    //     }
    // });
        // $("#rollno").keyup(function(){
        // var selection = window.getSelection().toString();
        // if ( selection !== '' ) {
        //     return;
        // }

        // var $this = $(this);
        // var input = $this.val();
        // input = input.replace(/[\W\s\._\-]+/g, '');
        // var split = 4;
        // var chunk = [];
        // var il = input.length;
        //     if(il>=12){
        //         // input = input.replace(/[\W\s\._\-]+/g, '');
        //         chunk.push( input.substr( 0, 6) );
        //         chunk.push( input.substr( 6, 8) );
        //         chunk.push( input.substr( 8, 9) );
        //         chunk.push( input.substr( 9, 12) );
        //     }
            // else if(il>8 && il<=9){
            //     input = input.replace(/[\W\s\._\-]+/g, '');
            //     chunk.push( input.substr( 0, 6) );
            //     chunk.push( input.substr( 6, 8) );
            //     // chunk.push( input.substr( 8, 9) );
            // }
            // else if(il>9 && il<=12){
            //     input = input.replace(/[\W\s\._\-]+/g, '');
            //     chunk.push( input.substr( 0, 6) );
            //     chunk.push( input.substr( 6, 8) );
            //     chunk.push( input.substr( 8, 9) );
            //     chunk.push( input.substr( 9, il) );
            // }
            // else if(il>12){
            //     input = input.replace(/[\W\s\._\-]+/g, '');
            //     chunk.push( input.substr( 0, 6) );
            //     chunk.push( input.substr( 6, 8) );
            //     chunk.push( input.substr( 8, 9) );
            //     chunk.push( input.substr( 9, 12) );
            // }
            // else if (il<12) {
            //     input = input.replace(/[\W\s\._\-]+/g, '');
            //     chunk.push( input.substr( 0, il) );
            // }


            // split = ( i >= 5 && i <= 8 ) ? 4 : 3;
            // chunk.push( input.substr( i, split ) );
        // $this.val(function() {
        //     return chunk.join("-").toUpperCase();
        // });

    // } );

</script>
<!--===============================================================================================-->
{{--<script src="/js/main.js"></script>--}}

</body>
</html>