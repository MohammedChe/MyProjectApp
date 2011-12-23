<?php


$username="username";
$password="password";
$database="your_database";

mysql_connect("a.db.shared.orchestra.io",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM User";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();

echo "<b><center>Database Output</center></b><br><br>";

$i=0;
while ($i < $num) {

$email=mysql_result($result,$i,"Email");
$password=mysql_result($result,$i,"Password");

echo "<b>Email:$email</b><br>Password: $password<br>";

$i++;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyProjectApp</title>
</head>

<body>
<p>
TESTING
</p>
</body>
</html>