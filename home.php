<?php 
//register.php

require_once 'includes/global.inc.php';

if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

//initialize php variables used in the form
$title = "";
$error = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

	//retrieve the $_POST variables
	$title = $_POST['title'];
	$owner = $_POST['owner'];
	
	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();
	
	if($success)
	{
	    //prep the data for saving in a new user object
	    $data['title'] = $title;
		$data['owner'] = $owner;
	    //create the new user object
	    $newCat = new Category($data);
	
	    //save the new user to the database
	    $newCat->save(true);
	
	    //redirect them to a welcome page
	    header("Location: home.php");
	    
	}

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
<title>Categories</title>
</head>
<body>
<?php echo ($error != "") ? $error : ""; ?>
<form action="home.php" method="post">
  Title:
  <input type="text" value="<?php echo $title; ?>" name="title" />
  <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
  <br/>
  <input type="submit" value="Add" name="submit-form" />
</form>
</body>
</html>