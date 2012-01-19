<?php

require_once 'includes/global.inc.php';


if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
  $user = unserialize($_SESSION['user']);
  
  if(isset($_POST['m'])) { 
  
  $userTools = new UserTools();
  $success = $userTools->removeBookmark($_POST['m'], $user->id);
  
//  if($_GET['c'] == "recent"){
//	  $link = "Location: home.php";
//  }
//  else{
	 // $link = "Location: home.php?c=" . $_GET['c'];
//  }

 // header($link);
  
  }
}
?>