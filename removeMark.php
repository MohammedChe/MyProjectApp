<?php

require_once 'includes/global.inc.php';


if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
  $user = unserialize($_SESSION['user']);
  
  if(isset($_POST['m'])) { 
  
  $m = mysql_real_escape_string($_POST['m']);
  
  $userTools = new UserTools();
  $userTools->removeBookmark($m, $user->id);

  }

    echo $m;
    echo $_POST['m'];
}
?>