<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

$email=$_POST['email'];
$passw=$_POST['passw'];
$passcon=$_POST['passcon'];

$emailError = "";
$passError = "";
$passConError = "";

function validateEmail()
{
   $isEmailValid = false;
   
	if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL))
    {
   		 $emailError = "This email is not valid";
    }
  else
    {
		$isEmailValid = true;
    }
	
	return $isEmailValid;
}



function validatePassword()
{
	$isPassValid = false;
	
	if ($passw === $passcon)
	{
		$isPassValid = true;
	}
	else
	{
		$passConError = "Does not match your password";
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

}
else
{
}

 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyProjectApp</title>
</head>

<body>

<form action="" method="post">
<table width="200" border="1">
  <tr>
    <th scope="row">Email:</th>
    <td><input type="text" name="email"></td>
	<?PHP
	if ($emailError != "")
	{
	?>
    <td>
    <?PHP
	echo $emailError;
	?>
    </td>
    <?PHP
	}
    ?>
  </tr>
  <tr>
    <th scope="row">Password</th>
    <td><input type="password" name="passw"></td>
    <?PHP
	if ($passError != "")
	{
	?>
    <td>
    <?PHP
	echo $passError;
	?>
    </td>
    <?PHP
	}
    ?>
  </tr>
  <tr>
    <th scope="row">Confirm Password</th>
    <td><input type="password" name="passcon"></td>
    <?PHP
	if ($passConError != "")
	{
	?>
    <td>
    <?PHP
	echo $passConError;
	?>
    </td>
    <?PHP
	}
    ?>
  </tr>
  <tr>
  <td align="center" colspan="3">
  <input type="Submit">
  </td>
  </tr>
</table>
</form>


</body>
</html>
