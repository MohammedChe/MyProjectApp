<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */


require_once 'includes/global.inc.php';

if (isset($_SESSION['logged_in'])) {
    header('Location: home.php');
}
else{

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
            header('Location: home.php');
            exit;
        }else{
            $error = "Incorrect email or password. Please try again.";
        }
    }

    $errorReg = "";
    $emailReg = "";
    $passwordReg = "";
    $password_confirmReg = "";


    //////////////////////////////////////////////////////////
    //check to see that the form has been submitted
    if(isset($_POST['submit-form'])) {

        //retrieve the $_POST variables
        $emailReg = $_POST['email'];
        $passwordReg = $_POST['password'];
        $password_confirmReg = $_POST['confirm_password'];

        //initialize variables for form validation
        $success = true;
        $userTools = new UserTools();

        //validate that the form was filled out correctly
        //check to see if user name already exists
        if($userTools->checkEmailExists($emailReg))
        {
            $errorReg .= "This email is already registered.<br/> \n\r";
            $success = false;
        }

        if(strlen($passwordReg) < 6)
        {
            $errorReg .= "Password must be 6 characters or over.<br/> \n\r";
            $success = false;
        }
        //check to see if passwords match
        if($passwordReg != $password_confirmReg) {
            $errorReg .= "Passwords do not match.<br/> \n\r";
            $success = false;
        }

        if ( filter_var($emailReg, FILTER_VALIDATE_EMAIL)  == FALSE)
        {
            $errorReg .= "Email address not valid.<br/> \n\r";
            $success = false;
        }

        if($success)
        {
            //prep the data for saving in a new user object
            $data['email'] = $emailReg;
            $data['password'] = md5($passwordReg); //encrypt the password for storage

            //create the new user object
            $newUser = new User($data);

            //save the new user to the database
            $newUser->save(true);

            //log them in
            $userTools->login($emailReg, $passwordReg);

            header('Location: home.php');
            exit;
        }
        else{
            header('Location: index.php');
        }

    }
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>MyProjectApp</title>

    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <link rel="stylesheet" href="styles/mobile.css" />


    <script type="text/javascript">

        $().ready(function() {

            $("#formRegister").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password2"
                    }
                },
                messages: {
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    }

                }
            });

            $("#formLogin").validate({
                rules: {
                    email: {
                        required: true,
                        email: false
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    }
                }
            });
        });
            </script>
</head>
<body>

<!-- Start of first page -->
<div data-role="page" id="intro">

    <div data-role="header">
        <h1>MyProjectApp</h1>
    </div><!-- /header -->

    <div data-role="content">

        <div class="content-secondary">
            <div data-role="controlgroup">
                <a href="#login" data-role="button">Login</a>
                <a href="#register" data-role="button">Register</a>
            </div>
        </div><!-- end content-secondary -->

        <div class="content-primary">
            <p>Login/Register to Continue</p>
        </div><!-- end content-primary -->

    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <h4>MyProjectApp|MohammedChe</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<!-- Start of login page -->
<div data-role="page" id="login">

    <div data-role="header" data-position="fixed">

        <a href="#intro" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <h1>Login</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the login page</p>
        <?php$error?>
        <form id="formLogin" action="login.php" data-ajax="false" method="post">
            <label for="email">Email:</label>
            <input class="required email" type="text" name="email" id="email" value=""  />
            <label for="password">Password:</label>
            <input class="required" type="password" name="password" id="password" value=""  />
            <button data-inline="true" data-theme="b" type="submit" name="submit-login">Login</button>

        </form>
    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <h4>MyProjectApp|MohammedChe</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<!-- Start of register page -->
<div data-role="page" id="register">

    <div data-role="header" data-position="fixed">
        <a href="#intro" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <h1>Register</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the register page</p>
        <?php$errorReg?>
        <form id="formRegister" class="validate" action="register.php" data-ajax="false"  method="post">
            <label for="email">Email:</label>
            <input type="text" class="required email" name="email" id="email" value=""  />
            <label for="password">Password:</label>
            <input type="password" class="required" name="password" id="password2" value=""  />
            <label for="confirm_password"> Confirm Password:</label>
            <input type="password" class="required" name="confirm_password" id="confirm_password" value=""  />
            <button data-inline="true" data-theme="b" type="submit" name="submit-form">Register</button>
        </form>

    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <h4>MyProjectApp|MohammedChe</h4>
    </div><!-- /footer -->
</div><!-- /page -->

</body>
</html>