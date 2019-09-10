<!DOCTYPE html>
<html>
<head>
    <title>Exam Instructions | {{$exam->test_name}} | {{session('coachingName')}}, Powered by Smrtbook</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <meta name=theme-color content="#2d70b8">
    <style>
        body,html{background-color:#fff;color:#636b6f;font-family:Raleway,sans-serif;font-weight:100;height:100vh;margin:0;
            -webkit-user-select: none; /* Safari 3.1+ */
            -moz-user-select: none; /* Firefox 2+ */
            -ms-user-select: none; /* IE 10+ */
            user-select: none; /* Standard syntax */
        }.titlePath{height:40px;line-height:40px;font-size:20px;font-weight:700;color:#676568;background:#BCE8F5}.bluebg{position:absolute;bottom:0;height:300px}
        .btn{float:right;border:1px solid #636b6f;padding:24px 56px;cursor:pointer;font-size: 34px;}
        .btn:hover{cursor:pointer;color:#fff;background:#2d70b7}
        .first{width: 100%;}
        .second{display: none}
        .sysInstText1{height: 75vh; overflow: auto;padding: 20px;}
        .footing{font-size:24px;width: 100%;background: #2d70b7;position: fixed;bottom: 0px;text-align: center;color: white;margin: 0;padding: 2px;font-weight: 600;}
        @media (min-width: 62em) {
            .first{width: 80%;float: left;}
            .second{width: 20%;float: right;display: block}
            .btn{padding:4px 25px;font-size: 100%;}
            .footing{font-size: 100%;}
            .sysInstText1{height: 68vh;}
        }

    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-120242667-1');
    </script>
</head>
<body style="padding: 0;margin: 0;" onload="setTimeout(closeWin, 100000);">

<div style="font-family:sans-serif;padding: 2px;margin:0;padding-left:20px;background: #2d70b7;font-size: 36px;color:white;font-weight: 400">
    {{$exam->test_name}} | {{session('coachingName')}}
</div>

<div class="first">
    <div style="border-right: 1px solid #636b6f;border-bottom: 1px solid #636b6f">
        <div class="titlePath" id="instruction" style="padding-left:15px;">Instructions</div>
        <div class="sysInstText1">
            <span style="font-size:18px;"><strong>IMPORTANT NOTE<br>
                    <p style="font-size: 90%;color: #2d70b7;">You can only attempt this exam Once, so make sure you read all the instructions carefully.</p></strong></span>
            <ul> <li><span style="font-size:18px;"><strong>
                            {{--The purpose of this Test is to help you perform better in Your Final Entrance Exams.--}}
                            Please attempt the exam without trying to cheat.
                        </strong></span></li> <br>

                <li><span style="font-size:18px;"><strong>
                            Make Sure Javascript is enabled in your browser. In case you had disabled Javascript,<a href="chrome://settings/content/javascript" target="_blank" style="color:#636b6f;">Please enable Javascript </a> before proceeding further.</strong></span></li> <br>


                <li><span style="font-size:18px;"><strong>
                            Make sure you have a <b style="color: #2d70b7"> steady Internet connection</b> and <b style="color: #2d70b7">do not switch tabs during the exam</b> or you will be disqualified.
                            </strong></span></li> <br>
                <li><span style="font-size:18px;"><strong>If possible, do not attempt exams in mobile device and open in Chrome to use all the features. Some features may not be supported in old browsers. Apart from the exam part, you can use the website in your mobile.</strong></span></li><br>
                <li><span style="font-size:18px;"><strong>
                            Please stay connect to the internet during the Exam time.</strong></span></li> <br>
                <li><span style="font-size:18px;"><strong>
                            This exam is hosted by <b style="color: #2d70b7">{{session('coachingName')}}</b>. The Institute is fully responsible for any information provided in the exam.
                        </strong></span></li> <br>
                <li><span style="font-size:18px;"><strong>For any querry regarding any question, you can mark the question as Doubtfully (Only available in Beta for now)</strong></span></li> <br>
            </ul>
        </div>
    </div>
    <div style="width: 99%;padding: 5px;">
        <a href="/student/dashboard" style="line-height: 38px;text-decoration: none;">
        <div class="btn" style="float: left" >

                <strong>Go back</strong>

        </div></a>

        <div class="btn" onclick="showInfo('{{$exam->exam_code}}')" >
            <a style=" line-height: 38px;">
                <strong>Next</strong>
            </a>
        </div>



    </div>
</div>

<div class="second">
    <div style="padding: auto">
        <div style="width: 100%;">
            <img class="candidateImg" style="display:block;height:100px;margin: auto;" src="/img/NewCandidateImage.jpg">
        </div>
        <div id="name" class="candOriginalName" style="font-size: 20px; color: rgb(79, 104, 135); font-weight: bold;
        text-align: center;">{{session('username')}}</div>
        <div class="bluebg"></div>
    </div>
</div>
<p class="footing">SmrtBook.in | Version : 3.2.1</p>

<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function (e) {
        e.preventDefault();
    }
    function showInfo(id){
        var url = '/examStart/'+id;
        window.open(url,"myWindow",
            "width=1820,height=1500,menubar=no,status=no,location=no");
        myWindow.focus();                                     // Assures that the new window gets focus
    }

    function closeWin() {
        location.replace("/student/dashboard");
    }

</script>

</body>
</html>