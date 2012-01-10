<?php 
//register.php

require_once 'includes/global.inc.php';

//initialize php variables used in the form
$email = "";
$password = "";
$password_confirm = "";
$error = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form3'])) { 

	//retrieve the $_POST variables
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password-confirm'];

	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();
	
	//validate that the form was filled out correctly
	//check to see if user name already exists
	if($userTools->checkEmailExists($email))
	{
	    $error .= "This email is already registered.<br/> \n\r";
	    $success = false;
	}
	

	if(strlen($password) < 6)
	{
	    $error .= "Password must be 6 characters or over.<br/> \n\r";
	    $success = false;
	}
	//check to see if passwords match
	if($password != $password_confirm) {
	    $error .= "Passwords do not match.<br/> \n\r";
	    $success = false;
	}
	
	if ( filter_var($email, FILTER_VALIDATE_EMAIL)  == FALSE) 
	{
		$error .= "Email address not valid.<br/> \n\r";
		$success = false;
	}

	if($success)
	{
	    //prep the data for saving in a new user object
	    $data['email'] = $email;
	    $data['password'] = md5($password); //encrypt the password for storage
	
	    //create the new user object
	    $newUser = new User($data);
	
	    //save the new user to the database
	    $newUser->save(true);
	
	    //log them in
	    $userTools->login($email, $password);
	
	    //redirect them to a welcome page
	    header("Location: home.php");
	    
	}

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
<title>Registration</title>
</head>
<body>
<?php echo ($error != "") ? $error : ""; ?>
<form action="register.php" method="post">
  E-Mail:
  <input type="text" value="<?php echo $email; ?>" name="email" />
  <br/>
  Password:
  <input type="password" value="<?php echo $password; ?>" name="password" />
  <br/>
  Password (confirm):
  <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" />
  <br/>
  <input type="submit" value="Register" name="submit-form" />
</form>
</body>
</html>