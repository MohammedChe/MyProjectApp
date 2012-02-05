<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 16:53
 * To change this template use File | Settings | File Templates.
 */

if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
else{
    $error = "";
    $email = "";
    $password = "";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $userTools = new UserTools();
    if($userTools->login($email, $password)){
        //successful login, redirect them to a page
        header("Location: index.php");
    }else{
        $error = "Incorrect email or password. Please try again.";
    }
}

?>