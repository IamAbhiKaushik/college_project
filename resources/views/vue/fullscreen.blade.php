<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Fullscreen API</title>
        <!-- <link rel="stylesheet" href="css/base.css" type="text/css" media="screen"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <base target="content-frame">
        <style type="text/css">
            /* General font styles */
html {
    font: 100%/1.3 Verdana, Helvetica, Arial, sans-serif;
}

body {
    font: 70%/1.3 Verdana, Helvetica, Arial, sans-serif;
}

h1 {
    font: bold 2em Arial, sans-serif;
}
                       
h2 {                     
    font: bold 1.5em Arial, sans-serif;
}
                       
h3 {                     
    font: bold 1.25em Arial, sans-serif;
}
                       
h4 {                     
    font: bold 1.1em Arial, sans-serif;
}

/* Default resetting */
html, body, form, fieldset, legend, dt, dd {
    margin: 0;
    padding: 0;
}

h1, h2, h3, h4, h5, h6, p, ul, ol, dl {
    margin: 0 0 1em;
    padding: 0;
}

h1, h2, h3, h4, h5, h6 {
    margin-bottom: 0.5em;
}

h2 {
    margin-top: 20px;
}

pre {
    font-size: 1.5em;
}

li, dd {
    margin-left: 1.5em;
}

img {
    border: none;
    vertical-align: middle;
}

/* Basic element styles */
a {
    color: #000;
}

a:hover {
    text-decoration: underline;
}

html {
    color: #000;
    background: gold;
    min-height: 100%;   
}

body {
    margin-bottom: 30px;
}

ul {
    margin: 10px 0;
}


/* Structure */
.container {
    width: 560px;
    min-height: 600px;
    background: #fff;
    border: 1px solid #ccc;
    border-top: none;
    margin: 20px auto;
    padding: 20px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: 1px 1px 10px #000;
    -webkit-box-shadow: 1px 1px 5px #000;
    box-shadow: 1px 1px 10px #000;
}

@media screen and (max-width: 320px) {
    #container {
        width: 280px;
        padding: 10px;
    }
}

video {
    display: block;
    margin-bottom: 10px;
}


/* Fullscreen */
html:-moz-full-screen {
    background: red;
}

html:-webkit-full-screen {
    background: red;
}

html:-ms-fullscreen {
    background: red;
}

body:-ms-fullscreen { 
    overflow: auto; /* fix for IE11 scrollbar */
}

html:fullscreen {
    background: red;
}
        </style>
    </head>

    <body>

        <div class="container">
            <h1>
                Fullscreen API
            </h1>

            <section class="main-content">
                                <textarea placeholder="Write something here"></textarea>

                <p>A demo of the Fullscreen API, currently implemented in Firefox, Google Chrome, Safari, Opera, and IE 11+. Click this button to make the web site go full screen:</p>

                <p style="height: 40px">
                    <button id="view-fullscreen">Fullscreen</button>
                    <button id="cancel-fullscreen">Cancel fullscreen</button>
                    <button onclick="newWindow()">Click to open in new Window</button>
                </p>



                <p>Fullscreen state: I'm <b id="fullscreen-state">not </b>fullscreen</p>
                <p>The background should also turn red when in fullscreen.</p>

                <input type="text" placeholder="Any test text">

                <script>
                    document.addEventListener("keydown", function (evt) {
                        if (evt.keyCode == 17) { //CTR 
                            evt.preventDefault();
                        }
                        else{
                            console.log("keydown. You pressed the " + evt.keyCode + " key");    
                        }

                    }, false);
                </script>


                <h2>Fullscren for elements</h2>
                <p>You can also make just a certain element fullscreen. For instance, a video:</p>


                <video id="mario-video" controls width="320">
                    <source src="http://www.archive.org/download/Mario1_507/Mario1_507_512kb.mp4">
                    <source src="http://www.archive.org/download/Mario1_507/Mario1_507.ogv">
                </video>

                <button id="video-fullscreen">View fullscreen video</button>

                <p><i>Video taken from <a href="http://www.archive.org/details/Mario1_507">archive.org</a>.</i></p>
            </section>

            <p>All the code is available in the <a href="https://github.com/robnyman/robnyman.github.com/tree/master/fullscreen">Fullscreen repository on GitHub</a>.</p>
        </div>


        <!-- <script src="js/base.js"></script> -->
<script type='text/javascript'>
  document.onkeydown = function (e) {
    e.preventDefault();     
  }
  function newWindow(){
    // window.open('http://localhost:8000/full','winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350');
    window.open('http://localhost:8000/full',"myWindow",
            "width=1820,height=1500,menubar=no,status=no,location=no");
    myWindow.focus();                                     // Assures that the new window gets focus
  }

</script>
<!-- Script -->
<script type='text/javascript'>
 
 var count = 0;
 var myInterval;
 // Active
 window.addEventListener('focus', startTimer);

 // Inactive
 window.addEventListener('blur', stopTimer);

 function timerHandler() {
  count++;
  document.getElementById("seconds").innerHTML = count;
 }

 // Start timer
 function startTimer() {
  console.log('focus');
  myInterval = window.setInterval(timerHandler, 1000);
 }

 // Stop timer
 function stopTimer() {
    // alert('blue function called');
  // window.clearInterval(myInterval);
 }
</script>

<script type="text/javascript">
    document.addEventListener('contextmenu', event => event.preventDefault());
    // window.onfocus = function() { alert("Hello! I am an alert box!!"); }


    (function () {
    var viewFullScreen = document.getElementById("view-fullscreen");
    if (viewFullScreen) {
        viewFullScreen.addEventListener("click", function () {
            var docElm = document.documentElement;
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen();
            }
            else if (docElm.msRequestFullscreen) {
                docElm = document.body; //overwrite the element (for IE)
                docElm.msRequestFullscreen();
            }
            else if (docElm.mozRequestFullScreen) {
                docElm.mozRequestFullScreen();
            }
            else if (docElm.webkitRequestFullScreen) {
                docElm.webkitRequestFullScreen();
            }
        }, false);
    }

    var cancelFullScreen = document.getElementById("cancel-fullscreen");
    if (cancelFullScreen) {
        cancelFullScreen.addEventListener("click", function () {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
            else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            }
            else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }, false);
    }


    var fullscreenState = document.getElementById("fullscreen-state");
    if (fullscreenState) {
        document.addEventListener("fullscreenchange", function () {
            fullscreenState.innerHTML = (document.fullscreenElement)? "" : "not ";
        }, false);
        
        document.addEventListener("msfullscreenchange", function () {
            fullscreenState.innerHTML = (document.msFullscreenElement)? "" : "not ";
        }, false);
        
        document.addEventListener("mozfullscreenchange", function () {
            fullscreenState.innerHTML = (document.mozFullScreen)? "" : "not ";
        }, false);
        
        document.addEventListener("webkitfullscreenchange", function () {
            fullscreenState.innerHTML = (document.webkitIsFullScreen)? "" : "not ";
        }, false);
    }

    var marioVideo = document.getElementById("mario-video")
        videoFullscreen = document.getElementById("video-fullscreen");

    if (marioVideo && videoFullscreen) {
        videoFullscreen.addEventListener("click", function (evt) {
            if (marioVideo.requestFullscreen) {
                marioVideo.requestFullscreen();
            }
            else if (marioVideo.msRequestFullscreen) {
                marioVideo.msRequestFullscreen();
            }
            else if (marioVideo.mozRequestFullScreen) {
                marioVideo.mozRequestFullScreen();
            }
            else if (marioVideo.webkitRequestFullScreen) {
                marioVideo.webkitRequestFullScreen();
                /*
                    *Kept here for reference: keyboard support in full screen
                    * marioVideo.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                */
            }
        }, false);
    }
})();
</script>

    </body>
</html>