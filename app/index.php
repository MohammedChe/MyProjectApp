<?php

$username="user_081a1e6e";
$password="xlC4F!dR0%$A$&";
$database="db_081a1e6e";

mysql_connect("http://a.db.shared.orchestra.io",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO Users VALUES ('','mo@hotmail.com','password')";

mysql_query($query);

mysql_close();

?>