
<?php 
	
	$strings = ["Hello", "World", "PHP", "Programming"];
	for ($i = 0; $i < count($strings); $i++) {

		$strWithoutVowels = str_ireplace(["a", "e", "i", "o", "u"], "", $strings[$i]);

       $VowelCount = strlen($strings[$i]) - strlen($strWithoutVowels);
       echo "Orginal String : $strings[$i] , Vowel Count: $VowelCount, Reversed String: ".strrev($strings[$i])."<br>";
	}

?>
