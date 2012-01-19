<?php

require_once 'includes/global.inc.php';


if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
  $user = unserialize($_SESSION['user']);
  
  if(isset($_GET['m'])) { 
  
  $userTools = new UserTools();
  $success = $userTools->removeBookmark($_GET['m'], $user->id);
  
  header("Location: home.php");
  
  }
}
?>