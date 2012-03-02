<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

require_once '../includes/global.inc.php';

if (!isset($_SESSION['logged_in']))
{
    header('Location: index.php');
}

else
{
    $user = unserialize($_SESSION['user']);

    $url = $_GET['u'];
    $cat = $_GET['c'];
    $note = $_GET['n'];

    //initialize variables for form validation
    $userTools = new UserTools();
    $checkedURL = $userTools->checkURL($url);

    if (isset($checkedURL) && $checkedURL != false)
    {
        //prep the data for saving in a new user object
        $data['category'] = $cat;
        $data['owner'] = $user->id;
        $data['url'] = $checkedURL;
        $data['note'] = $note;

        $newBookmark = new Bookmark($data);

        if($newBookmark->save(true))
        {
            echo "Bookmark Added";
        }
        else
        {
            echo "Sorry your bookmark was not added, Please try again later";
        }

    }
    else
    {
        echo "URL doesn't exist";
    }
}

?>