<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */
require_once 'http://myprojectapp.orchestra.io/includes/global.inc.php';


$error = "";
$email = "";
$password = "";


    $email = $_POST['e'];
    $password = $_POST['p'];

    $userTools = new UserTools();
    if($userTools->login($email, $password)){
        //successful login, redirect them to a page
        echo = "login";
    }else{
        $error = "Incorrect email or password. Please try again.";
        echo = $error;
    }

?>