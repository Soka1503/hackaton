 <!DOCTYPE html>
<html>
<body>

<h1>My First Google Map</h1>

<?php
$lat = 63;
$lng = 16;
for($i=0;$i<5;$i++){
	$lat++;
	$lng++;
	$place="jajemen";
	$object[]=array("lat"=>$lat,"lng"=>$lng,"info"=>"<b>$place</b>");
	$other[]=array("Ingen blomning");
}
$array_json = json_encode($object);
$array_json_other = json_encode($other);	

?>

<div id="map" style="width:500px;height:500px"></div>

<script>
/*
function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(63,15),
		zoom:4.5,
		minZoom: 4.5,
	};
	var map=new google.maps.Map(document.getElementById("map"),mapProp);

	
	google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(map, event.latLng);
	});
	var marker = new google.maps.Marker({
		position:new google.maps.LatLng(63, 15)
	});
	marker.setMap(map);
	google.maps.event.addListener(marker,'click',function() {
		var infowindow = new google.maps.InfoWindow({
			content:"Hello World!"
		});
		infowindow.open(map,marker);
	});
	*/	
	
function initMap() {
	//Hämtar objektet med information om algblomning från php.
	var alg = JSON.parse('<?= $array_json_other; ?>');	
	//En ny karta från Google Maps anges med initiell zoom och utgångspunkt (Sundsvall).
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 4.5,
		minZoom: 4.5,
		center: {
			lat: 63,
			lng: 16
		}
	});
	//En ny inforuta anges.
	var infoWin = new google.maps.InfoWindow();
	//Färger till punkterna på kartan hämtas.
	var green='http://maps.google.com/mapfiles/ms/icons/green-dot.png';
	var red='http://maps.google.com/mapfiles/ms/icons/red-dot.png';
	var yellow='http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
	//Inställningar för klustret anges.
	var mcOptions = {styles: [{
	//grön	
	height: 66,
	url: "https://raw.githubusercontent.com/linasess/Datateknik-/master/green2.png",
	width: 66
	},
	{	
	//röd	
	height: 66,
	url: "https://raw.githubusercontent.com/googlemaps/v3-utility-library/master/markerclusterer/images/m3.png",
	width: 66
	}]}
	//Lägger till alla punkter från arrayen "locations" nedan.
	var markers = locations.map(function(location, i) {
		//Om algstatusen för platsen är "Ingen blomning" anges färgen grön till punkten.
	 	if(alg[i][0]=="Ingen blomning"){	
			var color=green;
		}
		//Om algstatusen för platsen är "Blomning" anges färgen röd till punkten.
		if(alg[i][0]=="Blomning"){
			var color=red;
		}
		//Om algstatusen för platsen är "Ingen uppgifte" anges färgen gul till punkten.
		if(alg[i][0]=="Ingen uppgift"){
			var color=yellow;
		}	 
		//Varje punkt anges med postition och färg.
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
	
}	  
</body>
</html> 