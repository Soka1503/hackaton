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
                   <?php
					include "db_connection.php";
					include('httpful.phar');
					$connect = new db_connection();
					$length = $connect->getLengthOfEventList(); 
					$object = "";
					$other = "";
					$persons = array();
					$p2="";
					$p=array();
					$personsInfo = "";
					for($i=0;$i<$length;$i++){
						$event = $connect->getEvent($i);
						$lat = (float)$event->getLatitude();
						$lng = (float)$event->getLongitude();
						while(strlen($lng)>9){
							$lng=substr($lng,0,-1);
						}
						while(strlen($lat)>9){
							$lat=substr($lat,0,-1);
						}		
						//----------------
						//Hämta adresss
						$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng;
						
						//Svaret tilldelas en variabel
						$response = \Httpful\Request::get($url)
							->send();
						
						$rows = json_decode($response,true);
						
						$result = $rows['results'];
						if($result != null){
							$components= $result[0];
							$address=$components['formatted_address'];	
						}
						else{
							$address = "Okänd adress";
						}
						//----------------------------	
						$date = $event->getDatee();
						$time = $event->getTimee();
						$title = $event->getTitle();
						$description = $event->getDescription();
						$persons[] = $connect->getPersonsFromEvent($event->getEventID());
						for($i2=0;$i2<count($persons);$i2++){
							$p=$connect->getPersonPNo($persons[$i2]);
							if($p2 != $p->getPersonID()){
								$personsInfo .= $p."<br>";
								$p2=$p->getPersonID();
							}	
						}
						$category[]=array($title);
						//var_dump($personsInfo);
						$object[]=array("lat"=>$lat,"lng"=>$lng,"info"=>"<b>$title</b><br>Beskrivning: $description<br>$address<br>Tid och datum: $date $time<br>Personerna som ska gå på eventet är:<br>$personsInfo");
						
					}
					$person = $connect->getPersonPNo($_SESSION['personalnumber']);
					
					$latlng[] = array("lat"=>$person->getLatitude(),"lng"=>$person->getLongitude());
					$array_json = json_encode($object);	
					$array_json_category = json_encode($category);
					$array_json_latlng = json_encode($latlng);
					?>

					<div id="map" style="width:500px;height:500px"></div>

					<script>
					function initMap() {
						//Hämtar objektet med information om algblomning från php.
						var category = JSON.parse('<?= $array_json_category; ?>');
						var latlng = JSON.parse('<?= $array_json_latlng; ?>');
						//En ny karta från Google Maps anges med initiell zoom och utgångspunkt (Sundsvall).
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 10,
							minZoom: 4.5,
							center: {
								lat: latlng[0][0],
								lng: latlng[1][0]
							}
						});
						//En ny inforuta anges.
						var infoWin = new google.maps.InfoWindow();
						//Färger till punkterna på kartan hämtas.
						var green='http://maps.google.com/mapfiles/ms/icons/green-dot.png';
						var red='http://maps.google.com/mapfiles/ms/icons/red-dot.png';
						var yellow='http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
						var promenad= 'https://github.com/Soka1503/hackaton/blob/master/walk.png?raw=true';
						var fika = 'https://github.com/Soka1503/hackaton/blob/master/bild2.png?raw=true';
						var bio= 'https://github.com/Soka1503/hackaton/blob/master/film.png?raw=true';
						var golf= ' https://github.com/Soka1503/hackaton/blob/master/bild3.png?raw=true';
						//Inställningar för klustret anges.
						var mcOptions = {styles: [{
						//grön	
						height: 66,
						url: "https://raw.githubusercontent.com/linasess/Datateknik-/master/green2.png",
						width: 66
						}]}
						//Lägger till alla punkter från arrayen "locations" nedan.
						var markers = locations.map(function(location, i) {
							var image = 'https://github.com/scottdejonge/map-icons.git/src/icons/cafe.svg';
							if(category[i][0]=="golf"){	
								var color=golf;
							}
							if(category[i][0]=="promenad"){	
								var color=promenad;
							}
							if(category[i][0]=="fika"){	
								var color=fika;
							}
							if(category[i][0]=="bio"){	
								var color=bio;

							}
							else{
								var color=green;	
							}
							var marker = new google.maps.Marker({
							
								position: location,
								icon: color
						  
							});
							//En inforutan anges till varje punkt där informationen också kommer från arrayen "locations" nedan.
							google.maps.event.addListener(marker, 'click', function(evt) {
								infoWin.setContent(location.info);
								infoWin.open(map, marker);
							})
							//Punkten retuneras slutligen från funktionen.
							return marker;
						});

						//Lägger til ett kluster av punkterna.
						var markerCluster = new MarkerClusterer(map, markers,mcOptions);
						//En funktion som bestämmer inställningarna för klustret.
						markerCluster.setCalculator(function(markers, numStyles){
							var index = 0;
							//Tar fram längden av varje kluster.
							var lengthOfCluster = markers.length;
							//En loop som går igenom alla punkter i klustret.
							for(var i=0;i<lengthOfCluster;i++){	
								//Om ikonen i klustret är röd anges index=2 som representeras av röd (se ovan)
								//och sedan bryts loopen. Färgen på ikonen för klustret blir alltså röd om
								//någon punkt i klustret är röd, dvs har status algblmoning.
								if(markers[i]['icon'].includes("red")){
									var index=2	;
									break;
								}
								//Om ikonen är grön dvs inte har algblomning anges index=1 som representeras av färgen grön.
								if(markers[i]['icon'].includes("green")){	
									index=1;
								}	
							}
							//Funtionen returnerar, för varje kluster, längden på klustret samt inställnigar (i detta fall
							//färg och storlek på ikon).
							return {
							text: lengthOfCluster,
							index: index
							};
						}); 
							
					}
					//Hämtar objektet med information från php.
					var obj = JSON.parse('<?= $array_json; ?>');
					//Alla punkter med medföljande information läggs till.
					var locations = obj;
					//Laddar kartan.
					google.maps.event.addDomListener(window, "load", initMap);
					</script>
					<!--Klustret hämtas från Google Maps-->
					<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
					</script>
					<!--Kartan hämtas från Google Maps som anropar javascriptfunktionen 'initMap'-->
					<script async defer
					src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTmzSil2kh4Qii5NGbMuS6UWUoXSzzExk&callback=initMap">
					</script>
                </div>
                <div class="col-md-6">
                    <h1 style="color:#291579;font-family:'Cambria';"><strong>INSTRUKTIONER </strong></h1>
                    <h2 style="font-family:'Cambria';">Klicka på en symbol på kartan för att få mer information om vem som skapat träffen och när den kommer att inträffa. Om du är intresserad av träffen kan du ta kontakt med skaparen av den.  </h2>
                 
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
