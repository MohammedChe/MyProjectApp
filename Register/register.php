<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

//$email=$_POST['email'];
//$passw=$_POST['passw'];
//$passcon=$_POST['passcon'];

$email="sff";
$passw="sss";
$passcon="ssss";

function validateEmail()
{
   $isEmailValid = false;
	
	return $isEmailValid;
}



function validatePassword($passw, $passcon)
{
	$isPassValid = false;
	
	if ($passw === $passcon)
	{
		$isPassValid = true;
	}
	
	return $isPassValid;
}

//function isValid()
//{
//	return validateEmail() && validatePassword();
//}

if (validateEmail() && validatePassword($passw, $passcon))
{
	
	mysql_connect("a.db.shared.orchestra.io",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$query = "INSERT INTO User VALUES ('','$email','$passw')";
	mysql_query($query);

	mysql_close();

	//header("Location: ../");

}
else
{
	
	//header("Location: index.php");
}

echo validateEmail();
echo validatePassword();
echo isValid();
 
?>
