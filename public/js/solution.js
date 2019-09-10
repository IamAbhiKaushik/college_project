var total,
    currentQ,
    response,
    result;
currentQ =1;



var __PDF_DOC,
    __PDF_DOC2,
    __CURRENT_PAGE,
    __CURRENT_PAGE2,
    __TOTAL_PAGES,
    __PAGE_RENDERING_IN_PROGRESS = 0,
    __CANVAS = $('#pdf-canvas').get(0),
    __CANVAS_CTX = __CANVAS.getContext('2d');

__CANVAS2 = $('#pdf-canvas2').get(0);
    __CANVAS_CTX2 = __CANVAS2.getContext('2d');

var currentSubject = '';
// var questionType = [];
// questionType['P'] = 'Physics';
// questionType['C'] = 'Chemistry';
// questionType['M'] = 'Maths';
//
// questionType['0'] = 'Single Correct';
// questionType['1'] = 'Multiple Correct';
// questionType['2'] = 'Integer Correct';

function fetchResponse(pdf_url,pdf_url2,id,q_no){
    $.ajax({
        url: '/solutionApi/'+id,
        type: "GET",
        dataType: "text",
        success: function (data) {
            abc = JSON.parse(data);
            response = JSON.parse(abc.response);
            result = JSON.parse(abc.result);

            total = result.totalQ;
            // document.getElementById("response").innerHTML =response[1]['answer'];
            // document.getElementById("answer").innerHTML = response[1]['correct'];
            // document.getElementById("user-time").innerHTML = response[1]['time'];
            // document.getElementById("avg-time").innerHTML =response[1]['avgTime'];
            // document.getElementById("marks-distro").innerHTML =response[1]['MaxMarks']+' / -'+ response[1]['negative'];
            // document.getElementById("this-subject").innerHTML =response[1]['qType'];
            // currentSubject = response[1]['qType'];

            // console.log(abc);
        },
        fail: function () {
            console.log("Encountered an error");
            document.getElementById("demo").innerHTML ='Encountered an error';
        }
    });
    showPDF(pdf_url,pdf_url2,q_no);
}

function showPDF(pdf_url,pdf_url2,q_no) {
    $("#pdf-loader").show();
    PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
        __PDF_DOC = pdf_doc;
        __TOTAL_PAGES = __PDF_DOC.numPages;
        // Hide the pdf loader and show pdf container in HTML
        $("#pdf-loader").hide();
        $("#pdf-contents").show();
        $("#pdf-total-pages").text(__TOTAL_PAGES-1);
        // Show the first page
        showPage(q_no+1);
    }).catch(function(error) {
        // If error re-show the upload button
        $("#pdf-loader").hide();
        $("#upload-button").show();
        alert(error.message);
    });;




    PDFJS.getDocument({ url: pdf_url2 }).then(function(pdf_doc) {
        __PDF_DOC2 = pdf_doc;
        __TOTAL_PAGES2 = __PDF_DOC2.numPages;
        // Hide the pdf loader and show pdf container in HTML
        $("#pdf-loader2").hide();
        $("#pdf-contents2").show();
        // $("#pdf-total-pages").text(__TOTAL_PAGES);
        // Show the first page
        showPage2(q_no+1);
    }).catch(function(error) {
        // If error re-show the upload button
        $("#pdf-loader").hide();
        $("#upload-button").show();
        alert(error.message);
    });;



}

function showPage(page_no) {
    __PAGE_RENDERING_IN_PROGRESS = 1;
    __CURRENT_PAGE = page_no;
    // alert(__CURRENT_PAGE);

    // Disable Prev & Next buttons while page is being loaded
    $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');
    // While page is being rendered hide the canvas and show a loading message
    $("#pdf-canvas").hide();
    $("#page-loader").show();
    $("#download-image").hide();

    // Update current page in HTML

    $("#pdf-current-page").text(page_no-1);

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



function showPage2(page_no) {
    __PAGE_RENDERING_IN_PROGRESS = 1;
    __CURRENT_PAGE2 = page_no;
    $("#pdf-canvas2").hide();
    $("#page-loader2").show();

    __PDF_DOC2.getPage(page_no).then(function(page) {
        // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
        var scale_required2 = __CANVAS2.width / page.getViewport(1).width;

        // Get viewport of the page at required scale
        var viewport2 = page.getViewport(scale_required2);

        // Set canvas height
        __CANVAS2.height = viewport2.height;

        var renderContext2 = {
            canvasContext: __CANVAS_CTX2,
            viewport: viewport2
        };

        // Render the page contents in the canvas
        page.render(renderContext2).then(function() {
            __PAGE_RENDERING_IN_PROGRESS = 0;

            // Show the canvas and hide the page loader
            $("#pdf-canvas2").show();
            $("#page-loader2").hide();
        });
    });
}


// Upon click this should should trigger click on the #file-to-upload file input element
// This is better than showing the not-good-looking file input element

// Previous page of the PDF
$("#pdf-prev").on('click', function() {
    if(__CURRENT_PAGE != 2) {
        // __CURRENT_PAGE = __CURRENT_PAGE-1;
        showPage(--__CURRENT_PAGE);
        showPage2(--__CURRENT_PAGE2);
        // document.getElementById("response").innerHTML = response[__CURRENT_PAGE-1]['answer'];
        // document.getElementById("answer").innerHTML = response[__CURRENT_PAGE-1]['correct'];
        // document.getElementById("user-time").innerHTML = response[__CURRENT_PAGE-1]['time'];
        // document.getElementById("avg-time").innerHTML = response[__CURRENT_PAGE-1]['avgTime'];
        // document.getElementById("this-subject").innerHTML = response[__CURRENT_PAGE-1]['qType'];
        // document.getElementById("marks-distro").innerHTML = response[__CURRENT_PAGE-1]['MaxMarks'] + ' / -' + response[__CURRENT_PAGE]['negative'];
        document.getElementById('impo-one').style.color= '#fff';
    }


});

// Next page of the PDF
$("#pdf-next").on('click', function() {
    if(__CURRENT_PAGE != __TOTAL_PAGES) {
        // __CURRENT_PAGE = __CURRENT_PAGE + 1;
        showPage(++__CURRENT_PAGE);
        showPage2(++__CURRENT_PAGE2);
        // document.getElementById("response").innerHTML = response[__CURRENT_PAGE-1]['answer'];
        // document.getElementById("answer").innerHTML = response[__CURRENT_PAGE-1]['correct'];
        // document.getElementById("user-time").innerHTML = response[__CURRENT_PAGE-1]['time'];
        // document.getElementById("avg-time").innerHTML = response[__CURRENT_PAGE-1]['avgTime'];
        // document.getElementById("this-subject").innerHTML = response[__CURRENT_PAGE-1]['qType'];
        // document.getElementById("marks-distro").innerHTML = response[__CURRENT_PAGE-1]['MaxMarks'] + ' / -' + response[__CURRENT_PAGE]['negative'];
        document.getElementById('impo-one').style.color = '#fff';
    }
});


function question(q_no) {

        showPage(q_no+1);
        showPage2(q_no+1);

        __CURRENT_PAGE = q_no+1;
        // document.getElementById("response").innerHTML = response[__CURRENT_PAGE-1]['answer'];
        // document.getElementById("answer").innerHTML = response[__CURRENT_PAGE-1]['correct'];
        // document.getElementById("user-time").innerHTML = response[__CURRENT_PAGE-1]['time'];
        // document.getElementById("avg-time").innerHTML = response[__CURRENT_PAGE-1]['avgTime'];
        // document.getElementById("this-subject").innerHTML = response[__CURRENT_PAGE-1]['qType'];
        // document.getElementById("marks-distro").innerHTML = response[__CURRENT_PAGE-1]['MaxMarks'] + ' / -' + response[__CURRENT_PAGE]['negative'];
        document.getElementById('impo-one').style.color = '#fff';
    $("#questionModal").modal({keyboard: true});

}

// Download button
$("#download-image").on('click', function() {
    $(this).attr('href', __CANVAS.toDataURL()).attr('download', 'page.png');
});

function issue(exam_id) {
    var data = document.getElementById('issue').value;
    // var messageT = document.getElementById('issueT').value;
    if (data != ''){
        $.ajax({
            url: '/api/student/addIssue',
            type: "POST",
            data:{q: __CURRENT_PAGE,paper:exam_id,message:data},
            dataType: "text",
            success: function (data) {
                document.getElementById("successID").innerHTML = data;
            },
            fail: function () {
                console.log("Encountered an error");
                document.getElementById("successID").innerHTML ='Encountered an error, Please try again';
            }
        });
        console.log(data);
    }
}



