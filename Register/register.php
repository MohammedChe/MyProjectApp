<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

$email=$_POST['email'];
$passw=$_POST['passw'];
$passcon=$_POST['passcon'];

function validateEmail()
{
	if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL))
    {
		echo "E-Mail is not valid";
    	return false;
    }
	
 	else
    {
		echo "E-Mail valid";
   		return true;
    }
}



function validatePassword()
{
	$isPassValid = false;
	
	if ($passw === $passcon)
	{
		echo "Password valid";
		$isPassValid = true;
	}
	else
	{
		echo "Password is not valid";
	}
	
	return $isPassValid;
}

function isValid()
{
	return validateEmail() && validatePassword();
}

if (isValid())
{
	
	mysql_connect("a.db.shared.orchestra.io",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$query = "INSERT INTO User VALUES ('','$email','$passw')";
	mysql_query($query);

	mysql_close();

	header("Location: ../");

}
else
{
	header("Location: index.php");
}

 
?>
