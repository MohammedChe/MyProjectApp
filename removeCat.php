<?php

require_once 'includes/global.inc.php';


if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
  $user = unserialize($_SESSION['user']);
  
  if(isset($_GET['c'])) {
  
  $m = mysql_real_escape_string($_GET['c']);
  
  $userTools = new UserTools();
  $userTools->removeCategory($c, $user->id);

  }
    header("Location: index.php");
}
?>