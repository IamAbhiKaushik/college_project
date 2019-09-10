<!DOCTYPE html>
<html>
<head>
    <title>{{$exam->test_name}} | Hosted by EasyLrn</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/design.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120242667-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-120242667-1');
    </script>
</head>
<body style="margin: 0" onload="showPDF('/files/{{$exam->pdf}}.pdf')">
<div style="width: 100%;padding-bottom: 5px;padding-top: 5px;background: #2d70b8;color: white;">
    <div class="row" style="margin-right: 0;margin-left: 0;">
        <div class="col-sm-4">	<h4>{{$exam->test_name}}</h4></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h4 style="text-align: right">EasyLrn.com</h4></div>
    </div>
</div>
</div>
</div>

<ul class="info">
    <li><a onclick="information()" style="color: white;">Informations</a></li>
    <li><a href="#questionPaper" style="color: white;">Question Paper</a></li>
</ul>


<div class="row" style="margin: 0" id="root">
    <div class="col-lg-9 marked">
        <div style="background: #4e85c5;
    padding-left: 10px;">
            <button class="btn" style="font-size: 90%;background: #38a9eb;margin: 6px;border-radius: 5px;color: white; ">Question Paper (Section Wise)</button>
        </div>

        <div style="padding: 5px;width: 100%;border: 2px solid white">
            <p style="float: left;margin: 0;">Sections</p>
            <p id="timer" style="float: right;"> Time Left: <i id="minute">{{$exam->duration*60}}</i>:<i id="sec0">0</i><i id="sec1">0</i>
                <!-- <p style="float: right;margin: 0;">Time Clock</p> -->
        </div>
        <br>
        <!-- question_btn('.$kn_btn->question_number.') -->
        <ul class="nav sections" style="font-size: 110%;border-top: 1px solid #bdbdbd">
            @foreach($sections as $key=>$section)
                <li class="topsection" onclick="section({{$key}},{{$sec[$section[0]][0]->question_number}})" id = "currentSession{{$key}}" title="{{$sec[$section[0]][0]->question_number}}">
                    {{$section[1]}}
                </li>
            @endforeach
        </ul>

        <!-- <div style="width: 100%;background: #4e85c5;color: white;">
            <p style="text-align: right;margin-right: 15px;padding: 4px;margin-bottom: 1px;">
                View In  <select style="padding: 4px;color: black">
                    <option>Select</option>
                    <option>English</option>
                    <option>Hindi</option>
                </select>
            </p>

        </div> -->

        <!-- Qusetion section overflow scroll  -->

        <div class="question" style="width: 100%;height: 60vh;border: 1px solid #bdbdbd;overflow-x: hidden;overflow-y: scroll;padding: 1px;margin: 1px;">

            <p style="width: 100%;border-bottom: 1px solid #bdbdbd;font-weight: 600;padding-left: 10px;">Question No : <label id="currentQuestion"></label></p>


            <div id="pdf-main-container">
                <div id="pdf-loader">Loading document ...</div>
                <div id="pdf-contents">
                    <!-- <div id="pdf-meta">
                        <div id="pdf-buttons">
                            <button id="pdf-prev">Previous</button>
                            <button id="pdf-next">Next</button>
                        </div>
                        <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                    </div> -->
                    <canvas id="pdf-canvas" width="900"></canvas>
                    <div id="page-loader">Loading page ...</div>
                    <!-- <a id="download-image" href="#">Download PNG</a> -->
                </div>
            </div>

            <!-- <div style="width: 100%;padding-left: 40px;" class="integer_Correct">
                <b>Fill in the Correct Answer</b><br>
                <input type="text" name="integerType">
                <div id="vKeyboard" class="vKeyboard" style="width: 145px;"><span class="vKeyboardSplKeys" style="border-radius: 6px;">Backspace</span><br><span class="vKeyboardKeys" style="border-radius: 6px;">7</span><span class="vKeyboardKeys" style="border-radius: 6px;">8</span><span class="vKeyboardKeys" style="border-radius: 6px;">9</span><br><span class="vKeyboardKeys" style="border-radius: 6px;">4</span><span class="vKeyboardKeys" style="border-radius: 6px;">5</span><span class="vKeyboardKeys" style="border-radius: 6px;">6</span><br><span class="vKeyboardKeys" style="border-radius: 6px;">1</span><span class="vKeyboardKeys" style="border-radius: 6px;">2</span><span class="vKeyboardKeys" style="border-radius: 6px;">3</span><br><span class="vKeyboardKeys" style="border-radius: 6px;">0</span><span class="vKeyboardKeys" style="border-radius: 6px;">.</span><span class="vKeyboardKeys" style="border-radius: 6px;">-</span><br><span class="vKeyboardSplKeys" data="left" style="font-weight: normal; border-radius: 6px;">←</span><span class="vKeyboardSplKeys" data="right" style="font-weight: normal; border-radius: 6px;">→</span><br><span class="vKeyboardSplKeys" style="border-radius: 6px;">Clear All</span><br></div>
            </div> -->

            <div>
                <!-- <p style="margin:0;padding: 2px;">Options Are</p> -->
                @foreach($sec as $k=>$section)

                    <?php
                    foreach ($section as $kn => $kn_opt) {
                        $options[0] = '<div style="width: 100%;" class="single_Correct options" id="ansBox'.$kn_opt->question_number.'">
					<b>Choose Any One</b><br>
					 <label for="AT" style="padding: 5px;"><input type="radio" name="singleCorrect'.$kn_opt->question_number.'" id="AT" value="A" v-model="response['.$kn_opt->question_number.']"> A </label>
					<label for="BT" style="padding: 5px;"><input type="radio" name="singleCorrect'.$kn_opt->question_number.'" id="BT" value="B" v-model="response['.$kn_opt->question_number.']"> B </label>
					<label for="CT" style="padding: 5px;"><input type="radio" name="singleCorrect'.$kn_opt->question_number.'" id="CT" value="C" v-model="response['.$kn_opt->question_number.']"> C </label>
					<label for="DT" style="padding: 5px;"><input type="radio" name="singleCorrect'.$kn_opt->question_number.'" id="DT" value="D" v-model="response['.$kn_opt->question_number.']"> D </label>
					</div>';

                        $options[1] = '<div style="width: 100%;" class="multiple_Correct options" id="ansBox'.$kn_opt->question_number.'">
					<b>Choose Multiple Choices</b><br>
				<label for="AA"><input type="checkbox" name="singleCorrect'.$kn_opt->question_number.'" id="AA" value="A" v-model="response['.$kn_opt->question_number.']"> A </label>

				<label for="BB"><input type="checkbox" name="singleCorrect'.$kn_opt->question_number.'" id="BB" value="B" v-model="response['.$kn_opt->question_number.']"> B </label>
				<label for="CC"><input type="checkbox" name="singleCorrect'.$kn_opt->question_number.'" id="CC" value="C" v-model="response['.$kn_opt->question_number.']"> C </label>
				<label for="DD"><input type="checkbox" name="singleCorrect'.$kn_opt->question_number.'" id="DD" value="D" v-model="response['.$kn_opt->question_number.']"> D </label>
				</div>';
                        $options[2] = '<div style="width: 100%;padding-left: 40px;" class="integer_Correct options" id="ansBox'.$kn_opt->question_number.'">
					<b>Fill in the Correct Answer</b><br>
					<input type="text" name="integerType" v-model="response['.$kn_opt->question_number.']" id="integerAns'.$kn_opt->question_number.'">
				<div id="vKeyboard" class="vKeyboard" style="width: 145px;"><span class="vKeyboardSplKeys" style="border-radius: 6px;" onclick="integerAnswerCut()">Backspace</span><br><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(7)">7</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(8)">8</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(9)">9</span><br><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(4)">4</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(5)">5</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(6)">6</span><br><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(1)">1</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(2)">2</span><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(3)">3</span><br><span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerAnswer(0)">0</span>

				<span class="vKeyboardKeys" style="border-radius: 6px;" onclick="integerDecimal()">.</span>
				<span class="vKeyboardKeys" style="border-radius: 6px;" onclick = "integerAnswerMinus()">-</span><br>
				<!--<span class="vKeyboardSplKeys" data="left" style="font-weight: normal; border-radius: 6px;">←</span>
				<span class="vKeyboardSplKeys" data="right" style="font-weight: normal; border-radius: 6px;">→</span><br>-->
				<span class="vKeyboardSplKeys" style="border-radius: 6px;" onclick = "integerAnswerClear()">Clear All</span><br></div>
				</div>';


                        echo $options[$kn_opt->question_type];
                    }
                    ?>


                @endforeach

            </div>

        </div>

        <div style="width: 100%;border:1px solid #bdbdbd;padding: 0px;">
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-sm-10" style="padding: 8px;margin: 0;">
                    <label class="examBtn" onclick="mark()">Mark For Review & Next</label>
                    <label class="examBtn" onclick="clear()" id="clear">Clear Response</label>

                    <!-- <label>Hello</label> -->
                </div>
                <div class="col-sm-2" style="padding: 8px;margin: 0;">
                    <label class="examBtn" style="background-color: #0c7cd5;color: white;" onclick="save()">Save And Next</label>

                    <!-- <div style="border: 1px solid #bdbdbd;">Clear Response</div> -->
                </div>

            </div>


        </div>



    </div>
    <div class="col-lg-3 marked">
        <div style="width: 100%;text-align: center;padding: 30px;border:1px solid #bdbdbd; ">Easy | Test User<br>
            180100123 | Easylrn.com
            <br>
        </div>
        <div style="border:1px solid black">
            <div class="row" style="font-size: 90%;padding: 4px;margin: 0">

                <div class="leftSide">
                    <span title="Answered" class="demoBtn answered" >0</span>
                    <span>Answered</span>
                </div>
                <div class="rightSide">
                    <span title="Not Answered" class="demoBtn notAnswered" >1</span>
                    <span>Not Answered</span>
                </div>

                <div class="leftSide">
                    <span title="Not Visited" class="demoBtn notVisited" >0</span>
                    <span>Not Visited</span>
                </div>
                <div class="rightSide">
                    <span title="Marked for Review" class="demoBtn review" >0</span>
                    <span>Marked for Review</span>
                </div>

                <div style="float: left;width: 100%;">
                    <span title="Answered" class="demoBtn ansReview" >0</span>
                    <span>Answered & Marked for Review (will be considered for evaluation)</span>
                </div>

            </div>
            <div class="row" style="margin: 0;padding: 4px;height: 50.5vh;overflow: auto">

                @foreach($sections as $k=>$section)
                    <div class ="question_btns">
                        <div style="width: 100%;background: #4e85c5;color: white;padding: 8px;font-weight: 600">
                            @ {{$section[1]}}
                        </div>
                        <p style="margin:0;padding: 2px;">Choose a Question</p>
                        <?php
                        $arr = array_keys($sec[$section[0]]);
                        $last_key = end($arr);
                        foreach ($sec[$section[0]] as $kn => $kn_btn) {
                            if ($kn ==	0) {
                                echo '<div class="col-sm-3" onclick = "question_btn('.$kn_btn->question_number.')">
								<span title="Not Visited" class="q_button not_answered" id="qbtn'.$kn_btn->question_number.'">
									'.($kn+1).'</span>
							</div>';
                            }
                            else{
                                echo '<div class="col-sm-3" onclick = "question_btn('.$kn_btn->question_number.')">
								<span title="Not Visited" class="q_button not_visited" id="qbtn'.$kn_btn->question_number.'">
									'.($kn+1).'</span>
							</div>';
                            }
                        }
                        ?>
                    </div>
            @endforeach

            <!-- <div class="col-sm-3">
					<span title="Not Visited" class="q_button not_visited"> 2</span>
				</div>

				<div class="col-sm-3">
					<span title="Not Visited" class="q_button not_answered"> 2</span>
				</div>

				<div class="col-sm-3">
					<span title="Not Visited" class="q_button marked_review"> 2</span>
				</div>

				<div class="col-sm-3">
					<span title="Not Visited" class="q_button review_answered"> 2</span>
				</div>

				<div class="col-sm-3">
					<span title="Not Visited" class="q_button q_answered"> 2</span>
				</div> -->
            </div>
        </div>
        <div style="width: 100%;padding: 6px;margin: 0;">
            <form action='/submitEasy/{{$exam->id}}' method="POST" id="responseForm">
                {!! csrf_field() !!}
                <input type="hidden" id="mainResponse" name="response">
                <!-- <button class="btn btn-bg btn-success m-1 p-3" v-on:click="submit()" type="button">Submit</button> -->
                <div style="width:100%;padding: auto;text-align: center;">
                    <label class="examBtn" style="background-color: #0c7cd5;color: white;" v-on:click="submit()">Submit</label>
                    <!-- <div style="border: 1px solid #bdbdbd;">Clear Response</div> -->
                </div>
            </form>
        </div>
    </div>
</div>
<div style="border:1px solid #617B8C;background: #617B8C;color: white;padding: 0px;font-size:70%;text-align: center;">
    Version : 3.2.3 | SmrtBook.in
    <p style="display: none;" id="totalTime">{{$exam->duration}}</p>
</div>
<script src="/js/vue.js"></script>
<script src="/js/New/pdf.js"></script>

<script type="text/javascript" src="/js/design.js"></script>
</body>
</html>