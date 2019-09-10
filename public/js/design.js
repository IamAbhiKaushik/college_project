var app = new Vue({
  el: '#root',
  data: {
    response: [],
    finalresponse:[],
  },
  created(){
    for (var i = 100; i > 0; i--) {
        this.response[i] = [];
        this.finalresponse[i]={answer:[], time:0,correct:''};
        // var t = ['anser'=>[],'time'=>0];
        // this.finalresponse[i] = t;
        // this.finalresponse[i]['time']=0;
    }
  },
  methods: {
    submit: function(){
        // if (document.getElementById('connection-check').style.background=='green'){
            $('#mainResponse').val(JSON.stringify(app.finalresponse));
            $('#responseForm').submit();
            document.getElementById("timer").innerHTML = "Time Left: 00:00";
        // }
        // else{
        //     alert('No Internet Connection, Please check your Internet connection before Submitting.')
        // }
    }
  }
});




var __PDF_DOC,
    __CURRENT_PAGE,
    __TOTAL_PAGES,
    __PAGE_RENDERING_IN_PROGRESS = 0,
    __CANVAS = $('#pdf-canvas').get(0),
    __CANVAS_CTX = __CANVAS.getContext('2d');
currentQuestionNo = 1;
currentSection = 0;
var M = parseInt(document.getElementById('totalTime').innerHTML);
var S = 2;

second1=M*60;

var examSubmitter = 0
document.addEventListener('contextmenu', event => event.preventDefault());
document.onkeydown = function (e) {
    e.preventDefault();
}
$(window).blur(function() {
    if(examSubmitter == 3){
        app.submit();
    }
    else {
        examSubmitter += 1;
        alert('Total Page changes: ' + examSubmitter + '. If you switch tabs more than twice, or click on address bar of the given window, exam will be submitted automatically.');
    }
});
if(window.innerHeight > window.innerWidth){
    // examSubmitter -= 1;
    // alert("!!Use Landscape Mode in Mobile devices for a better View!!");
}

function showPDF(pdf_url) {
    // var pdf_url = 'https://s3.ap-south-1.amazonaws.com/smrtbook/2017p1.pdf';
    $("#pdf-loader").show();
    PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
        __PDF_DOC = pdf_doc;
        __TOTAL_PAGES = __PDF_DOC.numPages;
        // Hide the pdf loader and show pdf container in HTML
        $("#pdf-loader").hide();
        $("#pdf-contents").show();
        // $("#pdf-total-pages").text(__TOTAL_PAGES);
        // Show the first page
        showPage(1);
    }).catch(function(error) {
        // If error re-show the upload button
        $("#pdf-loader").hide();
        $("#upload-button").show();
        alert(error.message);
    });;
    var myVar = setInterval(myTimer, 1000);
}

function showPage(page_no) {
    page_no = page_no+1;
    if (page_no == 1) document.getElementById('currentQuestion').innerHTML = 'Instructions...Click on question to get back to question paper.';
    else document.getElementById('currentQuestion').innerHTML = currentQuestionNo;

    __PAGE_RENDERING_IN_PROGRESS = 1;
    __CURRENT_PAGE = page_no;
    // Disable Prev & Next buttons while page is being loaded
    $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');
    // While page is being rendered hide the canvas and show a loading message
    $("#pdf-canvas").hide();
    $("#page-loader").show();
    $("#download-image").hide();

    // Update current page in HTML
    $("#pdf-current-page").text(page_no);
    
    // Fetch the page
    __PDF_DOC.getPage(page_no).then(function(page) {
        // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
        var scale_required = __CANVAS.width / page.getViewport(1).width;

        // Get viewport of the page at required scale
        var viewport = page.getViewport(scale_required);

        // Set canvas height
        __CANVAS.height = viewport.height;

        var renderContext = {
            canvasContext: __CANVAS_CTX,
            viewport: viewport
        };
        
        // Render the page contents in the canvas
        page.render(renderContext).then(function() {
            __PAGE_RENDERING_IN_PROGRESS = 0;

            // Re-enable Prev & Next buttons
            $("#pdf-next, #pdf-prev").removeAttr('disabled');

            // Show the canvas and hide the page loader
            $("#pdf-canvas").show();
            $("#page-loader").hide();
            $("#download-image").show();
        });
    });
}

// Previous page of the PDF
$("#pdf-prev").on('click', function() {
    if(__CURRENT_PAGE != 1)
        showPage(--__CURRENT_PAGE);
});

// Next page of the PDF
$("#pdf-next").on('click', function() {
    if(__CURRENT_PAGE != __TOTAL_PAGES)
        showPage(++__CURRENT_PAGE);
});

function section(section,q){
    $( ".topsection" ).css( {"background": "white","color":"#36ace9" }); 
    document.getElementsByClassName('topsection')[section].style.background='#4e85c5';
    document.getElementsByClassName('topsection')[section].style.color='white';
    $( ".question_btns" ).css( "display", "none" ); 
    document.getElementsByClassName('question_btns')[section].style.display='block';
    currentSection = section;
    question_btn(q);
}

function changeBtn(id,type){
    var z = "#qbtn"+id;
     $(z).removeClass();
     $(z).addClass("q_button");
     $(z).addClass(type);
}
// question_btn is the onclick function for each question_btn
function question_btn(id){
    // in case quesiton no and pdf page do not match
    $( ".options" ).css( "display", "none" );
    if (id !=0){
        updateTime(currentQuestionNo);
        currentQuestionNo = id;
        document.getElementById('ansBox'+id).style.display='block';
        var zz = "#qbtn"+id;
        if ($(zz).hasClass("not_visited")) {
            changeBtn(id,'not_answered');
        }
    }
    showPage(id);
}

function updateTime(oldQ) {

    var delta = parseInt(document.getElementById('minute').innerHTML)*60+parseInt(document.getElementById('sec1').innerHTML);
    // console.log(delta);
app.finalresponse[currentQuestionNo]['time']= app.finalresponse[currentQuestionNo]['time']+ (second1 -  delta);
//     console.log(delta);
    second1 = delta;
    // app.responseTime[oldQ] = app.responseTime[oldQ]+
}

function save(){

    quesiton = currentQuestionNo+1;
    updateTime(currentQuestionNo);
    if (app.response[currentQuestionNo] !='') {
    app.finalresponse[currentQuestionNo]['answer'] = app.response[currentQuestionNo];
    //change the button background...
    changeBtn(currentQuestionNo,'q_answered');
    }
    else{
    changeBtn(currentQuestionNo,'not_answered');        
    }
    changeBtn(quesiton,'not_answered');
    // check if section has been changed
    session = currentSection+1;
    var firstQcheck =  document.getElementById("currentSession"+session);

    if(firstQcheck){
        var firstQ =  firstQcheck.title;
        if (quesiton==firstQ) {
            section(session,quesiton);
        }
        else{
            question_btn(quesiton);
        }
    }
    else{
        question_btn(quesiton);
    }



}

function mark(){
    // only design will change
    quesiton = currentQuestionNo+1;
    updateTime(currentQuestionNo);
    if (app.response[currentQuestionNo] !='') {
        app.finalresponse[currentQuestionNo]['answer'] = app.response[currentQuestionNo];
        changeBtn(currentQuestionNo,'review_answered');
    }
    else{
    changeBtn(currentQuestionNo,'marked_review');        
    }

    changeBtn(quesiton,'not_answered');

    // check if section has been changed
    session = currentSection+1;
    var firstQcheck =  document.getElementById("currentSession"+session);

    if(firstQcheck){
        var firstQ =  firstQcheck.title;
        if (quesiton==firstQ) {
            section(session,quesiton);
        }
        else{
            question_btn(quesiton);
        }
    }
    else{
        question_btn(quesiton);
    }

}

$('#clear').click(function() {
    // alert('Hello');
    var z = "input[name=singleCorrect"+currentQuestionNo+"]";
    app.response[currentQuestionNo] = [];
    $(z).prop('checked', false);
    $(z+':checkbox').prop('checked', false);
    changeBtn(currentQuestionNo,'not_answered');
});

function myTimer() {
    if(M<=0 && S<=0){
    // stop();
    app.submit();
    }
    if(S==0){
    S=60;
    M = M-1;
    document.getElementById("sec0").style.display ='none' ;
    }
    else if(S<=10 && S>0){
    document.getElementById("sec0").style.display ='inline';
    }
    S=S-1;
    document.getElementById("minute").innerHTML = M;
    document.getElementById("sec1").innerHTML = S;
}


function integerAnswer(i){
    var k = "integerAns"+currentQuestionNo;
    var ant =document.getElementById(k);
    ant.value = (ant.value).toString()+i;
    app.response[currentQuestionNo] = (ant.value).toString();
}


function integerAnswerCut(){
    var k = "integerAns"+currentQuestionNo;
    var ant =document.getElementById(k);
    str = (ant.value).toString();
    ant.value = str.substring(0, (str.length-1));
    app.response[currentQuestionNo] = ant.value;
}

function integerAnswerMinus(){
    var k = "integerAns"+currentQuestionNo;
    var ant =document.getElementById(k);
    str = (ant.value).toString();
    if (str.substring(0,1) == "-") {
        ant.value = str.substring(1);
    }
    else{ant.value = "-"+str;}
    app.response[currentQuestionNo] = ant.value;
}

function integerDecimal(){
    var k = "integerAns"+currentQuestionNo;
    var ant =document.getElementById(k);
    ant.value = (ant.value).toString()+".";
    app.response[currentQuestionNo] = (ant.value).toString();
}

function integerAnswerClear(){
    var k = "integerAns"+currentQuestionNo;
    document.getElementById(k).value ='';
    app.response[currentQuestionNo] = document.getElementById(k).value;
}

function information() {
    question_btn(0);
    // showPage(0);
}


var keepAliveTimeout = 1000;
Pageloaded();
function Pageloaded()
{
    if (window.location.hostname == 'www.smrtbook.in'){
        var url_api = 'http://www.smrtbook.in/api/check';
    }
    else if (window.location.hostname == 'smrtbook.in'){
        var url_api = 'http://smrtbook.in/api/check';
    }
    $.ajax(
        {
            type: 'GET',
            url: url_api,
            success: function(data)
            {
                document.getElementById('connection-check').style.background='green';
                document.getElementById('connection-check').innerHTML='Connected to Internet';
                setTimeout(function()
                {
                    Pageloaded();
                }, keepAliveTimeout);
            },
// start snippet
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (XMLHttpRequest.readyState == 4) {
                }
                else if (XMLHttpRequest.readyState == 0) {
                    document.getElementById('connection-check').style.background='red';
                    document.getElementById('connection-check').innerHTML='No Internet Connection';
                    // alert('no internet connection');
                    setTimeout(function()
                    {
                        Pageloaded();
                    }, keepAliveTimeout);
                    // Network error (i.e. connection refused, access denied due to CORS, etc.)
                }
                else {
                    // something weird is happening
                }
            }
        });
}


