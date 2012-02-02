<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

//require_once 'classes/detectDesktop.class.php';
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
    $redCat = "recent";

    if(isset($_POST['c'])) {
        $redCat = mysql_real_escape_string($_POST['c']);
    }

    if($redCat != "recent") {

        $theCat = $userTools->getCategory($redCat);
        $selectedCatIndex = $theCat->id;
        $selectedCat = $theCat->title;

    }

    else{

        if (isset($cat["title"])){
            $selectedCatIndex = $cat["id"];
            $selectedCat = $cat["id"];
            $redCat = $selectedCatIndex;
        }
        else{
            $marks = $userTools->getRecentBookmarks(18, $user->id);
            $redCat = "recent";
            $selectedCat = "Recent";
        }
    }

    if (isset($selectedCatIndex)){
        $marks = $userTools->getBookmarks($selectedCatIndex, $user->id);
    }



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
    <link rel="stylesheet" href="styles/mobile.css" />


</head>
<body>


<?php

if (!$login){

?>

<!-- Start of first page -->
<div data-role="page" id="intro">

    <div data-role="header">
        <h1>MyProjectApp</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>Login or Register to Continue</p>

        <div data-role="controlgroup">
            <a href="#login" data-role="button">Login</a>
            <a href="#register" data-role="button">Register</a>
        </div>

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
        <form method="post">
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
        <form method="post">
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

<?php
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else{

?>
<!-- Start of first page -->
<div data-role="page" id="home">

    <div data-role="header" data-position="fixed">
        <h1>Recent</h1>
        <div data-role="navbar" data-grid="b" >
            <ul>
                <li><a href="#" class="ui-btn-active ui-state-persist">Recent</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div><!-- /header -->

    <div data-role="content">



        <div class="content-primary">
            <ul data-role="listview" data-split-icon="delete" data-split-theme="d">


                <?php


                if(isset($marks[0])) {


    foreach ($marks as $key => $value)
    {
    $scheme = parse_url($value["url"], PHP_URL_SCHEME);
    $host = parse_url($value["url"], PHP_URL_HOST);
    $theURL2 = $scheme . "://" . $host;
    ?>


        <li><a href="<?php echo htmlentities($value["url"]);?>">
            <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL2;?>" />
            <h3 class="addLeftMargin"><?php echo $theURL2;?></h3>
            <p class="addLeftMargin"><?php echo $selectedCat ?></p>
        </a><a href="#" onClick="removeMark(<?php echo htmlentities($value["id"])?>,'<?php echo $redCat?>','<?php echo $selectedCat ?>');"  data-transition="slideup">Delete
        </a></li>



    <?php
}
}
else{

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(isset($marks["url"])){
        $scheme = parse_url($marks["url"], PHP_URL_SCHEME);
        $host = parse_url($marks["url"], PHP_URL_HOST);
        $theURL2 = $scheme . "://" . $host;
        ?>

        <li><a href="<?php echo htmlentities($marks["url"]);?>">
            <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL2;?>" />
            <h3 class="addLeftMargin"><?php echo $theURL2;?></h3>
            <p class="addLeftMargin"><?php echo $selectedCat ?></p>
        </a><a href="#" onClick="removeMark(<?php echo htmlentities($marks["id"])?>,'<?php echo $redCat?>','<?php echo $selectedCat ?>');"  data-transition="slideup">Delete
        </a></li>


        <?php

    }

    else{
        ?>

        <li><a href="#">
            <img src="images/default.png" />
            <h3 class="addLeftMargin">None</h3>
            <p class="addLeftMargin">Add a New Bookmark</p>
        </a></li>



        <?php
    }
}


?>



            </ul>
        </div><!--/content-primary -->



    </div><!-- /content -->

<!--    <div data-role="footer">-->
<!--        <div data-role="navbar">-->
<!--            <ul>-->
<!--                <li><a href="#">Latest</a></li>-->
<!--                <li><a href="#">Categories</a></li>-->
<!--                <li><a href="logout.php">Logout</a></li>-->
<!--            </ul>-->
<!--        </div>-->



        <div data-role="footer" data-id="tabs" data-position="fixed">

        </div>



<!--    </div><!-- /footer -->
</div><!-- /page -->



<!-- Start of second page -->
<div data-role="page" id="categories">

    <div data-role="header" data-position="fixed">
        <h1>Categories</h1>
        <div data-role="navbar" data-grid="b" >
            <ul>
                <li><a href="#home" >Recent</a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist">Categories</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div><!-- /header -->

    <div data-role="content">

        <div data-role="collapsible" data-collapsed="true" class="content-primary">


        <?php
        if (isset($cat[0])) {

                foreach ($cat as $key => $value)
                {
                    ?>
                    <h3><?php echo htmlentities($value["title"])?></h3>
                    <p>
                    <ul data-role="listview">
                    <li>first</li>
                    <li>second</li>
                    <li>third</li>
<!--                    <li><a onClick="getMarks(--><?php //echo htmlentities($value["id"])?><!--, '--><?php //echo htmlentities($value["title"])?><!--');" href="">--><?php //echo htmlentities($value["title"])?><!--<span class="ui-li-count">--><?php //echo $userTools->getCategoryCount( htmlentities($value["id"]), $user->id);?><!--</span></a></li>-->
                    </ul>
                    </p>


                    <?php
                }
        }
        else
        {
            if (isset($cat["id"])) {
                ?>

                <h3><?php echo htmlentities($cat["title"])?></h3>
                <p>
                <ul data-role="listview">
                    <li>first</li>
                    <li>second</li>
                    <li>third</li>
                    <!--                <li><a onClick="getMarks(--><?php //echo htmlentities($cat["id"])?><!--, '--><?php //echo htmlentities($cat["title"])?><!--');" href="">--><?php //echo htmlentities($cat["title"])?><!--<span class="ui-li-count">--><?php //echo $userTools->getCategoryCount( htmlentities($cat["id"]), $user->id);?><!--</span></a></li>-->
                </ul>
                </p>


                <?php


            }
            else {
                ?>
                No Categories

                <?php
            }
        }
        ?>

            </div>

    </div><!-- /content -->

    <div data-role="footer" data-id="tabs" data-position="fixed">

    </div>
</div><!-- /page -->



<?php
}

?>


</body>
</html>