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
    header('Location: index.php');
}

else {
    $user = unserialize($_SESSION['user']);

    //retrieve the $_POST variables
    $title = $_GET['t'];

    $userTools = new UserTools();

    //prep the data for saving in a new user object
    $data['title'] = $title;
    $data['owner'] = $user->id;
    
    //create the new user object
    $newCat = new Category($data);

    //save the new user to the database
    if($newCat->save(true))
    {
    	echo "Category Added";
    }
    else
    {
    	echo "Sorry your Category was not added, Please try again later";
    }

}

?>