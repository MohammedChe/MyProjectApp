<?php
//login.php

require_once 'includes/global.inc.php';

$error = "";
$email = "";
$password = "";

//check to see if they've submitted the login form
if(isset($_POST['submit-login'])) { 

	$email = $_POST['email'];
	$password = $_POST['password'];

	$userTools = new UserTools();
	if($userTools->login($email, $password)){ 
		//successful login, redirect them to a page
		header("Location: home.php");
	}else{
		$error = "Incorrect email or password. Please try again.";
	}
}
?>

<html>
<head>
	<title>Login</title>
</head>
<body>
<?php
if($error != "")
{
    echo $error."<br/>";
}
?>
	<form action="login.php" method="post">
	    Email: <input type="text" name="email" value="<?php echo $email; ?>" /><br/>
	    Password: <input type="password" name="password" value="<?php echo $password; ?>" /><br/>
	    <input type="submit" value="Login" name="submit-login" />
	</form>
</body>
</html>