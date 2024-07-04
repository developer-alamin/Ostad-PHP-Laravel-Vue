
<?php 

	// Input the three numbers 
	// and store it in variable 

	$num1 = 4; 
	$num2 = 5; 
	$num3 = 6; 

	// Using the if else statement to find the largest number 

	if ($num1 > $num2 && $num1 > $num3) { 
		echo "The largest Number is: $num1\n"; 
	} elseif ($num2 > $num1 && $num2 > $num3) { 
		echo "The largest Number is: $num2\n"; 
	} else { 
		echo "The largest Number is: $num3\n"; 
	} 

?>
