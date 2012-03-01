<?php

require_once 'includes/global.inc.php';


if(!isset($_SESSION['logged_in'])) {
	header('Location: index.php');
    exit;
}

else{
	
  $user = unserialize($_SESSION['user']);
  
  if(isset($_GET['m'])) {
  
  $m = mysql_real_escape_string($_GET['m']);
  
  $userTools = new UserTools();
  $userTools->removeBookmark($m, $user->id);
  
  echo "1";

  }
}
?>