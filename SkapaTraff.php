<?php
include('httpful.phar');
include "db_connection.php";
    // Starta sessionen
ob_start();
session_start();

    // kollar om man är inloggad, om inte skickas användaren till logg in sidan.
if (!isset($_SESSION['loggedIn'],$_SESSION['personalnumber']) || $_SESSION['loggedIn'] == false) {
	header("Location: LoggaIn.php");
	if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: LoggaIn.php");	
    }
	if(isset($_POST['logout'])) {
		session_destroy();
		echo "här";
		header('location: index.php');
	}	
}
//om användaren vill registrera ett event
		
	$title="";
	$street="";
	$postcode="";
	$city="";
	$date="";
	$description="";
	$time="";
//fixar inmatningsdata
//om användaren vill registrera en anvädare
	
if(isset($_POST['kategori'],$_POST['Gata'],$_POST['Beskrivning'],$_POST['Postnummer'],$_POST['Port'],$_POST['date'],$_POST['time'])){
	
	$title=($_POST['kategori']);
	$Street=($_POST['Gata']);
	$Postcode=($_POST['Postnummer']);
	$Port=($_POST['Port']);
	$date=($_POST['date']);	
	$time=($_POST['time']);
	$description=($_POST['Beskrivning']);
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$Port."+".$Street."+".$Postcode;
	
	//Svaret tilldelas en variabel
	$response = \Httpful\Request::get($url)
		->send();
	
	$rows = json_decode($response,true);
	
	$result = $rows['results'];
	$components= $result[0];
	
	$latitud=$components['geometry']['location']['lat'];
	$longitud=$components['geometry']['location']['lng'];
	$connect = new db_connection();
	$connect->addEvent($_SESSION['personalnumber'],$title,$description,$latitud,$longitud,$date,$time);
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
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
				 <form method="post" action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']);?>"/>
                    <h1 style="font-family:'Cambria';color:#291579;"><strong>SKAPA TRÄFF</strong></h1>
					<input class="input-lg" name='date' required="" type="date" style="width:500px;font-size:22px;font-family:'Cambria';">
					<input class="input-lg" type="text" name="time"  required="" placeholder="TID (HH.MM)" style="width:500px;font-size:22px;font-family:'Cambria';">					
					<input class="input-lg" type="text" name="Gata"  required="" placeholder="GATUADRESS" style="width:500px;font-size:22px;font-family:'Cambria';">
					<input class="input-lg" type="text" name="Port" required="" placeholder="GATUNUMMER" style="width:500px;font-size:22px;font-family:'Cambria';">
                    <input class="input-lg" type="text" name="Postnummer" required="" placeholder="POSTNUMMER" style="width:500px;font-size:22px;font-family:'Cambria';">
                    <input class="input-lg" type="text" name="Stad" required="" placeholder="STAD" style="width:500px;font-size:22px;font-family:'Cambria';">
                    <textarea class="input-lg" name="Beskrivning" required="" placeholder="BESKRIVNING" style="width:500px;font-size:22px;font-family:'Cambria';"></textarea>
		<select name="kategori" required="" style="width:500px;font-size:22px;font-family:'Cambria';">
					<option value = "" disabled selected hidden> VÄLJ KATEGORI </option>
					<option value="GOLF">GOLF</option>
					<option value="FIKA">FIKA</option>
					<option value="PROMENAD">PROMENAD</option>
					<option value="BIO">BIO</option>
					<option value="OVRIGT">ÖVRIGT</option>
										</select>	
                    <button class="btn btn-default" type="submit" style="font-size:22px;font-family:'Cambria';width:500px;">SKICKA </button></form>
                </div>
                <div class="col-md-6">
                    <h1 style="font-family:'Cambria';color:#291579;"><strong>INSTRUKTIONER</strong></h1>
                    <h2 style="font-family:'Cambria';">Här kan du skapa en träff.  När du har skapat en träff kan personer i din närhet se ditt event kontakta dig vid intresse. <p></div>
            </h2>
                    </div>
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
	    	<div class="knapp" style="text-align:center;"><button class="btn btn-default" name='logout' method="post" type="button" action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']);?>" style="width:430px;margin:8px;padding:14px;font-family:'Cambria';font-size:17px;">LOGGA UT</button></div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>