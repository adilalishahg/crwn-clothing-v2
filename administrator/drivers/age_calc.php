<?php

include_once('../DBAccess/Database.inc.php');

if($_POST['dob']!='')

{

	$dob = $_POST['dob'];

	$key	=	"-";

	$birthday	=	str_replace($key, "", convertDateToMySQL($dob));

	$today		=	str_replace($key, "", date("Y-m-d"));

	$age = (int)(($today - $birthday)/10000);

	if($age < 18)

	{

		//echo $age;

		echo "Invalid Date of Birth";

	}

	else

	{

		

		echo $age;

	}

}

?>

