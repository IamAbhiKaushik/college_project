<!DOCTYPE html>
<html>
<head>
    <title>Vue Paper Design</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="js/New/pdf.js"></script>
    <!-- <script src="js/New/pdf.worker.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<style type="text/css">

#upload-button {
    width: 150px;
    display: block;
    margin: 20px auto;
}

#file-to-upload {
    display: none;
}

#pdf-main-container {
    width: 400px;
    margin: 20px auto;
}

#pdf-loader {
    display: none;
    text-align: center;
    color: #999999;
    font-size: 13px;
    line-height: 100px;
    height: 100px;
}

#pdf-contents {
    display: none;
}

#pdf-meta {
    overflow: hidden;
    margin: 0 0 20px 0;
}

#pdf-buttons {
    float: left;
}

#page-count-container {
    float: right;
}

#pdf-current-page {
    display: inline;
}

#pdf-total-pages {
    display: inline;
}

#pdf-canvas {
    border: 1px solid rgba(0,0,0,0.2);
    box-sizing: border-box;
}

#page-loader {
    height: 100px;
    line-height: 100px;
    text-align: center;
    display: none;
    color: #999999;
    font-size: 13px;
}

#download-image {
    width: 150px;
    display: block;
    margin: 20px auto 0 auto;
    font-size: 13px;
    text-align: center;
}

</style>

</head>
<body onload="showPDF('http://localhost:8000/vuepdf')">

<div id='root'>
    <p>{{ $url }}</p>
</div>

<!-- <button id="upload-button">Select PDF</button>  -->
<input type="file" id="file-to-upload" accept="application/pdf" />

<div id="pdf-main-container">
    <div id="pdf-loader">Loading document ...</div>
    <div id="pdf-contents">
        <div id="pdf-meta">
            <div id="pdf-buttons">
                <button id="pdf-prev">Previous</button>
                <button id="pdf-next">Next</button>
            </div>
            <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
        </div>
        <canvas id="pdf-canvas" width="400"></canvas>
        <div id="page-loader">Loading page ...</div>
        <!-- <a id="download-image" href="#">Download PNG</a> -->
    </div>
</div>



<script type="text/javascript" src="js/main.js"></script>


</body>
</html>