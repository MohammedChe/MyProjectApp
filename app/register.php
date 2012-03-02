<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */
require_once '../includes/global.inc.php';

if (isset($_SESSION['logged_in']))
{
    header('Location: index.php');
}
else
{

    //retrieve the $_POST variables
    $email = $_GET['e'];
    $password = $_GET['p'];

    $success = true;

    $userTools = new UserTools();

    //validate that the form was filled out correctly
    //check to see if user name already exists
    if($userTools->checkEmailExists($email))
    {
        $success = false;
        echo "This email is already registered";
    }

    if ( filter_var($email, FILTER_VALIDATE_EMAIL)  == FALSE)
    {
        $success = false;
        echo "Email address not valid";
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

        echo "1";
    }

}

?>