<?php


$username="user_081a1e6e";
$password='xlC4F!dR0%$A$&';
$database="db_081a1e6e";

$email=$_POST['email'];
$passw=$_POST['passw'];


mysql_connect("a.db.shared.orchestra.io",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO User VALUES ('','$email','$passw')";
mysql_query($query);

mysql_close();
?>
