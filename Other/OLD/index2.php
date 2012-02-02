<?php
$con = mysql_connect("a.db.shared.orchestra.io","user_081a1e6e","xlC4F!dR0%$A$&");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}


@mysql_select_db("db_081a1e6e") or die( "Unable to select database");


$query = "INSERT INTO Users VALUES ('','mo@hotmail.com','password')";

mysql_query($query);

mysql_close($con);

?>