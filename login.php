<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */
require_once 'includes/global.inc.php';

if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
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
            //header('Location: http://myprojectapp.orchestra.io/index.php',TRUE,301);

            echo "<script>window.location = 'http://myprojectapp.orchestra.io/index.php'</script>";

            exit();
        }else{
            $error = "Incorrect email or password. Please try again.";
        }
    }
}
?>