<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";
$isValid = false;
$isPassValid = false;

$email=$_POST['email'];
$passw=$_POST['passw'];
$passcon=$_POST['passcon'];


function validate($email)
{
   $isEmailValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isEmailValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isEmailValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isEmailValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isEmailValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isEmailValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\-.]+$/', $domain))
      {
         // character not valid in domain part
         $isEmailValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isEmailValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isEmailValid = false;
         }
      }
      if ($isEmailValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isEmailValid = false;
      }
   }

   return $isEmailValid;
}


if ($passw === $passcon)
{
	$isPassValid = true;
}
   
else
{
	$isPassValid = false;
}


if ($isEmailValid = true && $isPassValid = true)
{
	$isValid = true;
}
else
{
	$isValid = false;
}

if ($isValid = true)
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
