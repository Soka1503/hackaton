<?php
	include('httpful.phar');

	$latitud=40.714224;
	$longitud=-73.961452;
	
	//URL till API.
	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitud.",".$longitud;
	
	//Svaret tilldelas en variabel
	$response = \Httpful\Request::get($url)
		->send();
	
	$rows = json_decode($response,true);
	
	$result = $rows['results'];
	$components= $result[0];
	$address=$components['formatted_address'];
	print($address);
?>