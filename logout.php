<?php

require_once 'includes/global.inc.php';

$userTools = new UserTools();
$userTools->logout();

header("Location: http://myprojectapp.orchestra.io/index.php");
exit();
?>