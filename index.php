<?php
    // Starta sessionen
    ob_start();
    session_start();

    // kollar om man är inloggad, om inte skickas användaren till logg in sidan.
   if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: LoggaIn.php");
		
    }
	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div style="text-align: center;"><IMG SRC="logga.jpg" ALT="image"></div>
    <title></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Map-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Testimonials.css">
</head>

<body>
    <div></div>
    <div>
        <nav class="navbar navbar-default navigation-clean-button">
             <div class="container">
                            <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php" style="color:#291579;padding:15px;font-size:33px;font-family:'Cambria';"><strong>HEM</strong> </a>
                                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                            </div>
                            <div class="collapse navbar-collapse" id="navcol-1">
                                <ul class="nav navbar-nav">
                                    <li role="presentation" style="color:#282821;font-size:22px;"><a href="SkapaTraff.php" style="color:#282821;font-family:'Cambria';"><strong>SKAPA TRÄFF</strong></a></li>
                                    <li role="presentation"><a href="OmOss.php" style="color:#282821;font-size:22px;font-family:'Cambria';"><strong>OM OSS</strong></a></li>
                                </ul>
                                <p class="navbar-text navbar-right actions"><a class="navbar-link login" href="LoggaIn.php" style="color:#282821;font-size:22px;font-family:'Cambria';"><strong>LOGGA IN</strong></a> <a class="btn btn-default action-button" role="button" href="GaMed.php" style="background-color:#291579;font-size:22px;font-family:'Cambria';"><strong>GÅ MED</strong></a></p>
                            </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe allowfullscreen="" frameborder="0" width="100%" height="400" src="https://www.google.com/maps/embed/v1/place?q=Paris%2C+France&amp;zoom=11"></iframe>
                </div>
                <div class="col-md-6">
                    <h1 style="color:#291579;font-family:'Cambria';"><strong>INSTRUKTIONER </strong></h1>
                    <h2 style="font-family:'Cambria';">1. Klicka ....</h2>
                    <h2 style="font-family:'Cambria';">2. ....</h2>
                    <h2 style="font-family:'Cambria';">3. </h2>
                    <h2 style="font-family:'Cambria';">4. </h2></div>
            </div>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
           <ul class="list-inline">
                <li><a href="index.php" style="font-family:'Cambria';font-size:20px;">HEM </a></li>
                <li><a href="SkapaTraff.php" style="font-family:'Cambria';font-size:20px;">SKAPA EVENT</a></li>
                <li><a href="OmOss.php" style="font-family:'Cambria';font-size:20px;">OM OSS</a></li>
                <li><a href="LoggaIn.php" style="font-family:'Cambria';font-size:20px;">LOGGA IN</a></li>
                <li style="font-family:'Cambria';"><a href="GaMed.php" style="font-size:20px;">GÅ MED</a></li>
            </ul>
            <p class="copyright" style="font-family:'Cambria';font-size:18px;">KNYTA KONTAKTER © 2018</p>
        </footer>
    </div>
    <div class="testimonials-clean"></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
