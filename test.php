Hi <?php echo htmlspecialchars($_POST['Fornamn']); ?>.
<?php echo htmlspecialchars($_POST['Efternamn']); ?>.
<?php echo htmlspecialchars($_POST['Adress']); ?>.
<?php echo htmlspecialchars($_POST['Personnummer']); ?>.
<?php echo htmlspecialchars($_POST['Port']); ?>.
<?php echo htmlspecialchars($_POST['Postnummer']); ?>.
<?php echo htmlspecialchars($_POST['Losenord']); ?>.
<?php echo htmlspecialchars($_POST['Telefonnummer']); ?>.
<?php
include('httpful.phar');

//fixar inmatningsdata


//om användaren vill registrera en anvädare
	
	
	$personalNumber=($_POST['Personnummer']);
	$firstName=($_POST['Fornamn']);
	$lastName=($_POST['Efternamn']);
	$Street=($_POST['Adress']);
	$Postcode=($_POST['Postnummer']);
	$Port=($_POST['Port']);
	$password=($_POST['Losenord']);	
	$phonenumber=($_POST['Telefonnummer']);
	

	//$address="hårdvallsgatan";
	/*$port=34;
	$street="oscarsgatan";
	$postcode="85239";*/
	
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
	
	print("Latitud " . $latitud . " AND Longitud: " . $longitud);
?>