<!DOCTYPE html>
<html>
<head>
    <title>Instructions | {{$exam->test_name}} | {{session('coachingName')}}, Powered by Smrtbook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name=theme-color content="#2d70b8">
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link rel="icon" href="" type="" />
    <style>
        body,html{ -webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none; background-color:#fff;color:#636b6f;font-family:Raleway,sans-serif;font-weight:100;height:100vh;}.titlePath{height:40px;line-height:40px;font-size:20px;font-weight:700;color:#676568;background:#BCE8F5}.bluebg{position:absolute;bottom:0;height:300px}.btn{float:right;border:1px solid #636b6f;padding:4px 25px;cursor:pointer}.btn:hover{cursor:pointer;color:#fff;background:#2d70b7}.instruction_area span.bttn{cursor:pointer;float:left;font-weight:700;height:38px;line-height:42px;text-align:center;width:34px;color:#fff}.not_visited{color:#000;background:url(/img/sprite.png) -105px -49px no-repeat}.not_answered{background:url(/img/sprite.png) -39px -48px no-repeat}.answered{background:url(/img/sprite.png) -5px -48px no-repeat}.review{background:url(/img/sprite.png) -72px -48px no-repeat}.review_marked_considered{background:url(/img/sprite.png) -6px -81px no-repeat}
        #secondPagep2{
            padding-left: 15px;font-weight: 600;overflow: auto; max-height: 200px;font-size: 12px;border-top: 1px solid #636b6f;
        }
        #left_side{
            width: 100%;
        }
        #right_side{
            width: 0;
            display: none;
        }
        .cusInstText1{
            padding-top:20px;padding-left:20px;max-height: 45vh;font-weight: 600; overflow: auto;
        }
        #left_side_info{
            border-right: none;border-bottom: 1px solid #636b6f
        }
        .heading{font-family:sans-serif;padding: 2px;margin:0;padding-left:20px;background: #2d70b7;font-size: 24px;color:white;font-weight: 400}


        @media (min-width: 62em) {
            body{margin:0}
            #secondPagep2{
                overflow: auto; max-height: 150px;font-size: 12px;border-top: 1px solid #636b6f;
            }
            #left_side{
                width: 80%;float: left;
            }
            #right_side{
                width: 20%;float: right;
                display: block;
            }
            .cusInstText1{
                max-height: 55vh; overflow: auto;
            }
            #left_side_info{
                border-right: 1px solid #636b6f;border-bottom: 1px solid #636b6f
            }
            .heading{
                font-size: 36px;
            }


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
<body style="padding: 0;margin: 0;">

<div class="heading">
    {{$exam->test_name}}<i style="font-size: 50%"> | {{session('coachingName')}}</i>
</div>

<div id="left_side">
    <div id="left_side_info">
        <div class="titlePath" id="instruction" style="padding-left:15px;">Other Important Instructions</div>

        {{--<div id="secondPagep1" style="overflow: hidden; padding-left: 8px;">--}}
            {{--<center><span id="otherImpInstru" style="display:none"><b><font size="4em" color="#2F72B7" id="otherInstruLabel">Other Important Instructions</font></b></span></center><br>--}}
            {{--<span id="secondPageLangView" style="float: right; padding: 2px;"><span class="viewIn">View in :</span>&nbsp;<select id="cusInst" onchange="parent.changeSysInst(this.value,'cusInstText','sysInstText')"><option value="cusInstText1">English</option><option value="cusInstText2">Hindi</option></select></span>--}}
        <div class="cusInstText1" ><div> <center><font size="4">Please read the instructions carefully </font></center> </div> <p><strong><u>General Instructions:</u></strong></p>
            <ol style="TEXT-ALIGN: left; LIST-STYLE-TYPE: decimal; PADDING-LEFT: 4%; PADDING-TOP: 3px">
                <li>You can not leave the exam window during the exam. Please doing so will cause your exam response information loss.
                And you might not be able to attempt the exam.
                </li>
                <li>Total duration of examination is <span class="completeDuration">{{$exam->duration}}</span> minutes.</li> <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li> <li>The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols: <table class="instruction_area" style="FONT-SIZE: 100%"> <tbody> <tr> <td><span class="bttn not_visited" title="Not Visited" style="color: black">1</span></td> <td>"Not Visited"- You have not visited the question yet.</td> </tr> <tr> <td><span class="bttn not_answered" title="Not Answered">2</span></td> <td>"Not Answered" - You have not answered the question.</td> </tr> <tr> <td><span class="answered bttn" title="Answered">3</span></td> <td>"Answered" - You have answered the question.</td> </tr>
                        <tr> <td><span class="review bttn" title="Marked for Review">4</span></td> <td>"Marked for Review" - You have NOT answered the question, but have marked the question for review.</td> </tr> <tr> <td><span class="review_marked_considered bttn" title="Answered &amp; Marked for Review">5</span></td> <td>"Answered and Marked for Review"- The question(s) "Answered and Marked for Review" will be considered for evaluation.</td> </tr> </tbody> </table> </li> <li style="LIST-STYLE-TYPE: none">The Marked for Review status for a question simply indicates that you would like to look at that question again.</li>
            </ol> <br> <strong><u>Navigating to a Question:</u></strong> <ol start="7" style="TEXT-ALIGN: left; LIST-STYLE-TYPE: decimal; PADDING-LEFT: 4%; PADDING-TOP: 3px "> <li>To answer a question, do the following: <ol style="TEXT-ALIGN: left; PADDING-LEFT: 4%; PADDING-TOP: 3px " type="a"> <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li> <li>Click on <b>Save &amp; Next</b> to save your answer for the current question and then go to the next question.</li> <li>Click on <b>Mark for Review &amp; Next</b> to save your answer for the current question, mark it for review, and then go to the next question.</li> </ol> </li> </ol> <p><b><u>Answering a Question : </u></b></p> <ol start="8" style="TEXT-ALIGN: left; LIST-STYLE-TYPE: decimal; PADDING-LEFT: 4%; PADDING-TOP: 3px "> <li>Procedure for answering a multiple choice type question: <ol style="TEXT-ALIGN: left; PADDING-LEFT: 4%; PADDING-TOP: 3px " type="a"> <li>To select your answer, click on the button of one of the options</li> <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <b>Clear Response</b> button</li> <li>To change your chosen answer, click on the button of another option</li> <li>To save your answer, you MUST click on the<b> Save &amp; Next</b> button</li> <li>To mark the question for review, click on the<b> Mark for Review &amp; Next</b> button.</li> </ol> <ol start="9" style="PADDING-LEFT: 1px; "> <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li> </ol> </li> </ol> <p><b><u>Navigating through sections:</u></b></p> <ol start="10" style="TEXT-ALIGN: left; LIST-STYLE-TYPE: decimal; PADDING-LEFT: 4%; PADDING-TOP: 3px "> <li>Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by clicking on the section name. The section you are currently viewing is highlighted.</li> <li>After clicking the Save &amp; Next button on the last question for a section, you will automatically be taken to the first question of the next section.</li> <li>You can shuffle between sections and questions anytime during the examination as per your convenience only during the time stipulated.</li> <li>Candidate can view the corresponding section summary as part of the legend that appears in every section above the question palette.</li>
            </ol>
        </div>


        <div>
            <div id="secondPagep2" >
                <div id="defaultDisclaimerDiv" style="">
                    <div id="defaultLangOptions" style="margin-top: 10px;">
                        <span id="defLang">your default language is :</span>
                        <select id="defaultLanguage"><option value="0">English</option><option value="1">English</option></select>
                        <br><span class="highlightText" id="multiLangInstru">Please note all questions will appear in your default language. This language can be changed for a particular question later on.</span>
                    </div>

                    <br>
                    <label class="" id="highlightDisclaimer" style="line-height:16px;margin-bottom: 0;padding-left: 0;">
                        <span style=" vertical-align:top"><input type="checkbox" style="margin-top:2px;float:left" id="myCheck">   </span>
                        <span style="width: 98%; display: block; margin-left: 1.5em;" id="agreementMessageDef"><span style="display: inline;" class="cusInstText1">I have read and understood the instructions. All computer hardware allotted to me are in proper working condition. I declare  that I am not in possession of / not wearing / not  carrying any prohibited gadget like mobile phone, bluetooth  devices  etc. /any prohibited material with me into the Examination Hall.I agree that in case of not adhering to the instructions, I shall be liable to be debarred from this Test and/or to disciplinary action, which may include ban from future Tests / Examinations</span><span style="display: none;" class="cusInstText2">मैंने निर्देश पढ़ लिया है और समझ लिया है। मुझे आवंटित किए गए सभी कंप्यूटर हार्डवेयर उचित कार्यशील स्थिति में हैं। मैं घोषणा करता / करती हूं कि मैं मोबाइल फोन, ब्लूटूथ डिवाइस आदि जैसे किसी प्रतिबंधित मोबाइल गैजेट को नहीं पहनने / न रखने / परीक्षा हॉल में मेरे साथ कोई निषिद्ध सामग्री नहीं ले रहा हूं। मैं मानता हूं कि निर्देशों का पालन न करने के मामले में, मैं इस टेस्ट और / या अनुशासनात्मक कार्यवाही से वंचित होने के लिए उत्तरदायी होगा, जिसमें भावी टेस्ट / परीक्षाओं से प्रतिबंध शामिल हो सकता है।</span></span><span style="width:98%;display:none;margin-left: 1.5em;" id="agreementMessageCustom"></span>
                    </label>

                    <br>
                </div>
            </div>
        </div>



    </div>
    <div style="width: 99%;padding: 5px;">
        <div class="btn" onclick="showInfo('{{$examUrl}}')" >
            <a style=" line-height: 38px;">
                <strong>Next</strong>
            </a>
        </div>
    </div>
</div>

<div id="right_side">
    <div style="padding: auto">
        <div style="width: 100%;">
            <img class="candidateImg" style="display:block;height:100px;margin: auto;" src="/img/NewCandidateImage.jpg">
        </div>
        <div id="name" class="candOriginalName" style="font-size: 20px; color: rgb(79, 104, 135); font-weight: bold;
        text-align: center;">{{session('username')}}</div>
        <div class="bluebg"></div>
    </div>

</div>
<p style="width: 100%;background: #2d70b7;position: fixed;bottom: 0px;text-align: center;color: white;margin: 0;padding: 1px;">SmrtBook.in | Version : 2.0.1</p>

<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function (e) {
        e.preventDefault();
    }
    function showInfo(id){
        var t= document.getElementById("myCheck").checked;
        if (t == true){
            var url = id;
            window.open(url,"myWindow",
                "width=1820,height=1500,menubar=no,status=no,location=no");
            myWindow.focus();                                     // Assures that the new window gets focus
        }
        else alert('Please Check the Undertaking to proceed further. Thanks');

    }

</script>

</body>
</html>