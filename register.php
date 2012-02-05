<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */
require_once 'includes/global.inc.php';

if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
else{

    $errorReg = "";
    $email = "";
    $password = "";
    $password_confirm = "";


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
            header("Location: index.php");
            exit;
        }

    }
}

?>