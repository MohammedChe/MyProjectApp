<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

require_once 'classes/detectDesktop.class.php';
require_once 'includes/global.inc.php';

if (!isset($_SESSION['logged_in'])) {
    $login = false;

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
            header("Location: mobile.php");
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
            header("Location: mobile.php");

        }

    }
}

else {
    $login = true;

    $user = unserialize($_SESSION['user']);

    $title = "";
    $error2 = "";
    $url = "";

    //check to see that the form has been submitted
    if (isset($_POST['submit-form3'])) {

        //retrieve the $_POST variables
        $title = $_POST['title'];
        $owner = $_POST['owner'];

        //initialize variables for form validation
        $success = true;
        $userTools = new UserTools();

        if ($success) {
            //prep the data for saving in a new user object
            $data['title'] = $title;
            $data['owner'] = $owner;
            //create the new user object
            $newCat = new Category($data);

            //save the new user to the database
            $newCat->save(true);

            //redirect them to a welcome page
            //header("Location: index.php");

        }

    }

    if (isset($_POST['submit-form2'])) {

        //retrieve the $_POST variables
        $url = $_POST['url'];
        $owner = $_POST['owner'];
        $cat = $_POST['pickCat'];

        //initialize variables for form validation
        $userTools = new UserTools();
        $checkedURL = $userTools->checkURL($url);

        if (isset($checkedURL) && $checkedURL != false) {
            //prep the data for saving in a new user object
            $data['category'] = $cat;
            $data['owner'] = $owner;
            $data['url'] = $checkedURL;
            //create the new user object
            $newBookmark = new Bookmark($data);

            //save the new user to the database
            $newBookmark->save(true);

            //redirect them to a welcome page
            //header("Location: home.php");

        }
        else
        {
            echo "URL doesnt exist";
        }
    }

    $cat = $userTools->getCategories($user->id);

    $marks2 = $userTools->getRecentBookmarks(25, $user->id);

}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyProjectApp</title>

    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>



</head>
<body>


<?php

if (!$login){

?>

<!-- Start of first page -->
<div data-role="page" id="intro">

    <div data-role="header">
        <h1>Welcome to MyProjectApp</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>Login or Register to Continue</p>

        <div data-role="controlgroup">
            <a href="#login" data-role="button">Login</a>
            <a href="#register" data-role="button">Register</a>
        </div>

    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<!-- Start of login page -->
<div data-role="page" id="login">

    <div data-role="header">

        <a href="#intro" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <h1>Login</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the login page</p>
        <form method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>"  />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>"  />
            <button  type="submit" name="submit-login">Login</button>
        </form>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<!-- Start of register page -->
<div data-role="page" id="register">

    <div data-role="header">
        <a href="#intro" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <h1>Login</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the login page</p>
        <form method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>"  />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>"  />
            <label for="password-confirm">Password:</label>
            <input type="password" name="password-confirm" id="password-confirm" value="<?php echo $password-confirm; ?>"  />
            <button  type="submit" name="submit-form">Register</button>
        </form>

    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<?php
}

else{

?>
<!-- Start of first page -->
<div data-role="page" id="home">

    <div data-role="header">
        <h1>Home</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is Home.</p>
        <p>View internal page called <a href="#categories">Categories</a></p>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->



<!-- Start of second page -->
<div data-role="page" id="categories">

    <div data-role="header">
        <h1>Categories</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the Categories page.</p>
        <p><a href="#home">Back to Home</a></p>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->



<?php
}

?>

</body>
</html>