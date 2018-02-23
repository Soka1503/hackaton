<?php
$year=195609099999;

control_age_personnr($year);
function control_age_personnr($year) {
	$control=true;
	$OK_year = 195812319999;
	if($year > $OK_year) {
		$control=false;
	}
	if($control==true){
		print("yolo");
	}
}
?>