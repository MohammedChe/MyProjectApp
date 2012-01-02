<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MyProjectApp = "a.db.shared.orchestra.io";
$database_MyProjectApp = "db_081a1e6e";
$username_MyProjectApp = "user_081a1e6e";
$password_MyProjectApp = "xlC4F!dR0%$A@@password@@";
$MyProjectApp = mysql_pconnect($hostname_MyProjectApp, $username_MyProjectApp, $password_MyProjectApp) or trigger_error(mysql_error(),E_USER_ERROR); 
?>