<?php
	include('httpful.phar');

	$port=34;
	$address="oscarsgatan";
	$zipcode="85239";
	
	//URL till api.
	//$url = "http://maps.googleapis.com/maps/api/geocode/json?address=24+hårdvallsgatan";
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$port."+".$address."+".$zipcode;
	
	//Svaret tilldelas en variabel
	$response = \Httpful\Request::get($url)
		->send();
	
	$rows = json_decode($response,true);
	
	$result = $rows['results'];
		
	$components= $result[0];

	$latitud=$components['geometry']['location']['lat'];
	$longitud=$components['geometry']['location']['lng'];
	
	print("Latitud " . $latitud . " AND Longitud: " . $longitud);
?>