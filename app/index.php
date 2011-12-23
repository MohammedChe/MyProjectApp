<?php

$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

$con = mysql_connect("a.db.shared.orchestra.io",$username,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}


@mysql_select_db($database) or die( "Unable to select database");


$query = "INSERT INTO Users VALUES ('','mo@hotmail.com','password')";

mysql_query($query);

mysql_close($con);

?>