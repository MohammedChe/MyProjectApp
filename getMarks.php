<?php

require_once 'includes/global.inc.php';

if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}

else{

    $user = unserialize($_SESSION['user']);
    $cat = $userTools->getCategories($user->id);

    if(isset($_POST['c'])) {
        $redCat = mysql_real_escape_string($_POST['c']);
        alert($redCat);
    }

    if (isset($redCat)){
        $marks = $userTools->getBookmarks($redCat, $user->id);
    }
    else{
        header("Location: index.php");
    }

}
//////////////////////////////////


if(isset($marks[0])) {

    foreach ($marks as $key => $value)
    {
        $scheme = parse_url($value["url"], PHP_URL_SCHEME);
        $host = parse_url($value["url"], PHP_URL_HOST);
        $theURL2 = $scheme . "://" . $host;

        $catTitle = $userTools->getCatTitle($value["category"], $user->id);

        ?>

    <li><a href="<?php echo htmlentities($value["url"]);?>">
        <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL;?>" />
        <h3 class="addLeftMargin"><?php echo $host;?></h3>
        <p class="addLeftMargin"><?php echo $catTitle["title"]; ?></p>
    </a><a href="#" onClick="removeMark(<?php echo htmlentities($value["id"])?>,'<?php echo $redCat?>','<?php echo $selectedCat ?>');"  data-transition="slideup">Delete
    </a></li>

    <?php
    }
}
else{

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(isset($marks["url"])){
        $scheme = parse_url($marks["url"], PHP_URL_SCHEME);
        $host = parse_url($marks["url"], PHP_URL_HOST);
        $theURL2 = $scheme . "://" . $host;

        $catTitle = $userTools->getCatTitle($marks["category"], $user->id);

        ?>

    <li><a href="<?php echo htmlentities($marks["url"]);?>">
        <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL;?>" />
        <h3 class="addLeftMargin"><?php echo $host;?></h3>
        <p class="addLeftMargin"><?php echo $catTitle["title"]; ?></p>
    </a><a href="#" onClick="removeMark(<?php echo htmlentities($marks["id"])?>,'<?php echo $redCat?>','<?php echo $selectedCat ?>');"  data-transition="slideup">Delete
    </a></li>
    <?php

    }

    else{
        ?>
    <div id="main" class="box grid_4">
        <div class="content round_all clearfix">
            <a href="#"><img class="screenshot" src="images/default.png" /></a>
        </div>
    </div>


    <?php
    }
}


?> 