<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */
require_once '../includes/global.inc.php';

$error = "";
$email = "";
$password = "";

//check to see if they've submitted the login form
if (isset($_GET["email"])  && isset($_GET["password"]) )
{
    $email = $_GET["email"];
    $password = $_GET["password"];

    $userTools = new UserTools();

    if($userTools->login($email, $password))
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}

?>