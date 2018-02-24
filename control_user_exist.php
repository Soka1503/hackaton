<?php
			//Läs in attributen från Person-databasen.
			//Spara till en array
			//Räckna antalet rader/iterationer/personer i databasen
			$personID = array();
	
			$i=0;
			while(!$sql=NULL){
				$sql = "SELECT personID FROM Person";
				$personID[$i] = $sql;
				$i=$i+1;
			}
	
			
			//En snabb kontroll för att se om passet finns i arrayen eller ej
			$written = "/" . $_POST["Personnummer"] . "/";
			$control=true;
			for($y=0; $y<$i; $y++){
				if (preg_match($written,$personID[$y])) {
					$control=false;
				}	
			}
			
			if($control==true){
				print("Användaren finns redan");
			}
?>