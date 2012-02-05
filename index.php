<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

require_once 'includes/global.inc.php';

if (!isset($_SESSION['logged_in'])) {
    $login = false;
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
            header('Location: index.php');
            exit;
        }

    }

    if (isset($_POST['submit-form2'])) {

        //retrieve the $_POST variables
        $url = $_POST['url'];
        $owner = $_POST['owner'];
        $cat = $_POST['select-choice-a'];
        $note = $_POST['note'];

        //initialize variables for form validation
        $userTools = new UserTools();
        $checkedURL = $userTools->checkURL($url);

        if (isset($checkedURL) && $checkedURL != false) {
            //prep the data for saving in a new user object
            $data['category'] = $cat;
            $data['owner'] = $owner;
            $data['url'] = $checkedURL;
            $data['note'] = $note;
            //create the new user object
            $newBookmark = new Bookmark($data);

            //save the new user to the database
            $newBookmark->save(true);

            //redirect them to a welcome page
            header('Location: index.php');
            exit;

        }
        else
        {
            echo "URL doesnt exist";
        }
    }


    $cat = $userTools->getCategories($user->id);

    $recentMarks = $userTools->getRecentBookmarks(12, $user->id);

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

    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <link rel="stylesheet" href="styles/mobile.css" />


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
        <h4>MyProjectApp - Che</h4>
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
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value=""  />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value=""  />
            <button data-inline="true" data-theme="b"  type="submit" name="submit-login">Login</button>

        </form>
    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->

<!-- Start of register page -->
<div data-role="page" id="register">

    <div data-role="header" data-position="fixed">
        <a href="#intro" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <h1>Login</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>This is the login page</p>
        <form action="register.php" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value=""  />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value=""  />
            <label for="password-confirm">Password:</label>
            <input type="password" name="password-confirm" id="password-confirm" value=""  />
            <button data-inline="true" data-theme="b" type="submit" name="submit-form">Register</button>
        </form>

    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <h4>MyProjectApp - Che</h4>
    </div><!-- /footer -->
</div><!-- /page -->

</body>
</html>