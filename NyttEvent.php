<?php
include('httpful.phar');

//fixar inmatningsdata


//om användaren vill registrera en anvädare
	
	
	$title=($_POST['Titel']);
	$Street=($_POST['Gata']);
	$Postcode=($_POST['Postnummer']);
	$Port=($_POST['Port']);
	$date=($_POST['date']);	
	$phonenumber=($_POST['Telefonnummer']);
	

	
	//URL till api.
	//$url = "http://maps.googleapis.com/maps/api/geocode/json?address=24+hårdvallsgatan";
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$Port."+".$Street."+".$Postcode;
	
	//Svaret tilldelas en variabel
	$response = \Httpful\Request::get($url)
		->send();
	
	$rows = json_decode($response,true);
	
	$result = $rows['results'];
	//var_dump($result);
	
	//$lat->lat;
	
	$components= $result[0];
	
	//var_dump($components);
	
	//var_dump($components['geometry']['location']['lat']);
	//var_dump($components['geometry']['location']['lng']);
	//var_dump($components['place_id']);
	
	
	$latitud=$components['geometry']['location']['lat'];
	$longitud=$components['geometry']['location']['lng'];
	
	//print("Latitud " . $latitud . " AND Longitud: " . $longitud);
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
    <nav class="navbar navbar-default navigation-clean-button">
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
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color:#291579;font-family:'Cambria';"><strong>DU HAR SKAPAT ETT NYTT EVENT</strong></h1>
					<h2 style="font-family:'Cambria';"><strong> TITEL: </strong><?php echo htmlspecialchars($_POST['Titel']); ?> </h2>
<h2 style="font-family:'Cambria';"> <strong>DATUM: </strong><?php echo htmlspecialchars($_POST['date']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>GATUADRESS: </strong><?php echo htmlspecialchars($_POST['Gata']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>GATUNUMMER: </strong><?php echo htmlspecialchars($_POST['Port']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>POSTNUMMER: </strong><?php echo htmlspecialchars($_POST['Postnummer']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>STAD: </strong><?php echo htmlspecialchars($_POST['Stad']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>BESKRIVNING: </strong><?php echo htmlspecialchars($_POST['Beskrivning']); ?> </h2>
<h2 style="font-family:'Cambria';"><strong>LONGITUD: </strong><?php echo $latitud; ?></h2>
<h2 style="font-family:'Cambria';"><strong>LATITUD: </strong><?php echo $longitud; ?></h2>
<a href="index.php" style="font-family:'Cambria';font-size:32px;">TRYCK HÄR FÖR ATT KOMMA TILL KARTAN</a></div>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>