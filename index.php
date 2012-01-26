<?php

require_once 'includes/global.inc.php';

if(isset($_SESSION['logged_in'])) {
	header("Location: home.php");
}

$error = "";
$errorReg = "";
$email = "";
$password = "";
$password_confirm = "";


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


//////////////////////////////////////////////////////////
//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

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
	    $errorReg .= "This email is already registered.<br/> \n\r";
	    $success = false;
	}
	

	if(strlen($password) < 6)
	{
	    $errorReg .= "Password must be 6 characters or over.<br/> \n\r";
	    $success = false;
	}
	//check to see if passwords match
	if($password != $password_confirm) {
	    $errorReg .= "Passwords do not match.<br/> \n\r";
	    $success = false;
	}
	
	if ( filter_var($email, FILTER_VALIDATE_EMAIL)  == FALSE) 
	{
		$errorReg .= "Email address not valid.<br/> \n\r";
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
///////////////////////////////////////

//////////////////////////////////




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" /> 

<title>MyProjectApp</title>

<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/text.css" />
<link rel="stylesheet" href="styles/960_fluid.css" />
<link rel="stylesheet" href="styles/main.css" />
<link rel="stylesheet" href="styles/bar_nav.css" />
<link rel="stylesheet" href="styles/side_nav.css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>

<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/jquery.hoverIntent.minified.js"></script>

<script type="text/javascript" src="scripts/sherpa_ui.js"></script>

<script>
function hideFirst()
{
	first.style.display = "none";
}
</script>

</head>

<body>
	<div id="wrapper" class="">
		<div id="top_nav" class="nav_down bar_nav round_all">
          <a href="#" class="minimize round_bottom"><span>minimize</span></a>
			<ul class="round_all clearfix">
				<li id="home"><a class="round_left" href="#">
					<img src="images/icons/grey/admin_user.png">
					Home</a>
				</li> 

             
				<li id="search" class="send_right"><a class="round_right" href="#">
					<img src="images/icons/grey/cash_register.png">
					Register
					<span class="icon">&nbsp;</span></a>
					<div class="drop_box right round_all">
						<?php echo ($errorReg != "") ? $errorReg : ""; ?>
                        <form method="post">
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
					</div>
				</li>
                
				<li class="send_right"><a class="round_right2" href="#">
					<img src="images/icons/grey/Key.png">
					Login
					<span class="icon">&nbsp;</span></a>
					<div class="drop_box right round_all">
                    
 
                    <?php
						if($error != "")
						{
   							 echo $error."<br/>";
						}
					?>
						<form  method="post" style="width:160px">
							<fieldset>
								<label>Email</label><input type="text" class="round_all" name="email" value="<?php echo $email; ?>">
							</fieldset>
							<fieldset>
								<label>Password</label><input class="round_all" name="password" type="password" value="<?php echo $password; ?>">
							</fieldset>
							<button  type="submit" class="send_right" name="submit-login">Login</button>
						</form>
					</div>
				</li>
                     
               
			</ul>
		</div>
        
        
        
        		<div class="clear"></div>

         		   <?php
				   
						if($error != "")
						{
   							 echo $error."<br/>";
					?>
						<div id="main" class="box grid_16">
			<div class="content round_all clearfix">
					
						<form  method="post" style="width:160px">
							<fieldset>
								<label>Email</label><input type="text" class="round_all" name="email" value="<?php echo $email; ?>">
							</fieldset>
							<fieldset>
								<label>Password</label><input class="round_all" name="password" type="password" value="<?php echo $password; ?>">
							</fieldset>
							<button  type="submit" class="send_right" name="submit-login">Login</button>
						</form>
                        	</div>
		</div>
        		<div class="clear"></div>

                        <?php
                        }
				   
						if($errorReg != "")
						{
   							 echo $errorReg."<br/>";
					?>
						<div id="main" class="box grid_16">
                        <div class="content round_all clearfix">
                                
                                    <form method="post">
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
                                        </div>
                    </div>
                            <div class="clear"></div>
              
                                    <?php
                                    }
                                    ?>
        
    </div>
   
    
    
        </div>
		<div class="clear"></div>
		
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4548504-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>