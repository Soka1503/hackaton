<?php
include('httpful.phar');

//om användaren vill registrera en anvädare
		
	$personalNumber="";
	$firstName="";
	$lastName="";
	$Street="";
	$Postcode="";
	$Port="";
	$password="";	
	$phonenumber="";
	
	
?>
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
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
        </div>
    </div>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action=NyttKonto.php>
                <h2 class="text-center" style="font-size:32px;font-family:'Cambria';color:#291579;"><strong>SKAPA</strong> ETT KONTO</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="Personnummer" id= 'Personnummer' required="" placeholder="PERSONNUMMER" maxlength="12" minlength="12" style="font-family:'Cambria';font-size:22px;">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="Losenord" id='Losenord' required="" placeholder="LÖSENORD" maxlength="20" minlength="8" style="font-size:22px;font-family:'Cambria';">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="Losenord-upprepa" required="" placeholder="UPPREPA LÖSENORD" maxlength="20" minlength="8" style="font-size:22px;font-family:'Cambria';">
                </div>
                <div class="form-group"></div>
                <input class="form-control" type="text" name="Fornamn" id = 'Fornamn' required="" placeholder="FÖRNAMN" style="font-family:'Cambria';font-size:22px;">
                <input class="form-control" type="text" name="Efternamn"id = 'Efternamn' required="" placeholder="EFTERNAMN" style="font-family:'Cambria';font-size:22px;">
                <input class="form-control" type="text" name="Adress" id= 'Adress' required="" placeholder="GATUADRESS" style="font-family:'Cambria';font-size:22px;">
                <input class="form-control" type="text" name="Port" id = 'Port' required="" placeholder="GATUNUMMER" style="font-family:'Cambria';font-size:22px;">
                <input class="form-control" type="text" name="Postnummer" id='Postnummer' required="" placeholder="POSTNUMMER" style="font-family:'Cambria';font-size:22px;">
				<input class="form-control" type="text" required="" name="Telefonnummer" placeholder="TELEFONNUMMER" id='Telefonnummer' style="font-family:'Cambria';font-size:22px;">
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" style="font-size:22px;background-color:#291579;font-family:'Cambria';">REGISTRERA </button>
                </div><a href="LoggaIn.php" class="already" style="color:#282821;font-size:18px;font-family:'Cambria';">HAR DU REDAN ETT KONTO? LOGGA IN HÄR</a></form>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
