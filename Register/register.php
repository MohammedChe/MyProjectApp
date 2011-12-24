<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

$email=$_POST['email'];
$passw=$_POST['passw'];
$passcon=$_POST['passcon'];

function validateEmail($email)
{
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}



function validatePassword()
{
	$isPassValid = false;
	
	if ($passw === $passcon)
	{
		$isPassValid = true;
	}
	
	return $isPassValid;
}

function isValid()
{
	return validateEmail($email) && validatePassword();
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
	//header("Location: index.php");
}

echo "email:   " +filter_var($email, FILTER_VALIDATE_EMAIL);
echo "email2:   " +validateEmail($email);
echo "pass:   " +validatePassword();
 
?>
