


<?php
$username="user_081a1e6e";
$password="xlC4F!dR0%$A$&";
$database="db_081a1e6e";

mysql_connect("http://mysql.orchestra.io",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO Users VALUES ('','mo@hotmail.com','password')";

mysql_query($query);

mysql_close();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>