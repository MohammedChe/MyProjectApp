<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 05/02/2012
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */
require_once '../includes/global.inc.php';

if (!isset($_SESSION['logged_in']))
{
    echo "not logged in";
}
else
{
    $user = unserialize($_SESSION['user']);
    $userTools = new UserTools();

    $recentMarks = $userTools->getRecentBookmarks(12, $user->id);

    echo json_encode($recentMarks);
}

?>