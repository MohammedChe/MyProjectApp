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

    $errorMark = "";

    if (isset($_POST['submit-form2'])) {

        //retrieve the $_POST variables
        $url = $_POST['url'];
        $owner = $_POST['owner'];
        $cat = $_POST['cat'];
        $note = $_POST['note'];

        if(empty($cat)){
            $cat = $_POST['select_choice_a'];
        }
        else
        {
            $data['title'] = $cat;
            $data['owner'] = $owner;

            $newCat = new Category($data);

            $newCat->save(true);
            $cat = $newCat->id;
        }

        //initialize variables for form validation
        $userTools = new UserTools();

        $checkedURL = $userTools->checkURL($url);

        if (isset($checkedURL) && $checkedURL != false) {
            //prep the data for saving in a new user object
            $data['category'] = $cat;
            $data['owner'] = $owner;
            $data['url'] = $checkedURL;
            $data['note'] = $note;
            //create the new user object
            $newBookmark = new Bookmark($data);

            //save the new user to the database
            $newBookmark->save(true);

            //redirect them to a welcome page
            header('Location: home.php');
            exit;

        }
        else
        {
            $errorMark = "URL doesn't exist";
        }
    }


    $cat = $userTools->getCategories($user->id);

    $recentMarks = $userTools->getRecentBookmarks(12, $user->id);

}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>CloudMark</title>

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>

    <script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="styles/mobile.css" />


    <script type="text/javascript">

        $().ready(function() {

            $("#formMarks").validate({
                rules: {
                    url: {
                        required: true
                    }
                },
                messages: {
                    url: "The URL can't be blank"
                }
            });

        <?php
        if(!empty($errorMark)){
            ?>
            $.mobile.changePage( "#add", { transition: "flip"} );
            <?php
            // echo "<p class='error'>". $errorMark ."</p>";
        }

        ?>
        });
    </script>


</head>
<body>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////START OF HOME PAGE////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->
<div data-role="page" id="home">

    <div data-role="header" data-position="fixed">
        <h1>Recent</h1>
    </div><!-- /header -->

    <div data-role="content">



        <div class="content-primary">
            <ul data-role="listview" data-split-icon="delete" data-split-theme="d">


                <?php


                if(isset($recentMarks[0])) {


                    foreach ($recentMarks as $key => $value)
                    {
                        $scheme = parse_url($value["url"], PHP_URL_SCHEME);
                        $host = parse_url($value["url"], PHP_URL_HOST);
                        $theURL = $scheme . "://" . $host;

                        $catTitle = $userTools->getCatTitle($value["category"], $user->id);
                        ?>


                        <li><a href="<?php echo htmlentities($value["url"]);?>">
                            <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL;?>" />
                            <div class="desc">
                                <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                <p class="addLeftMargin rightSide"><?php echo $catTitle["title"]; ?></p>
                                <p class="addLeftMargin note"><?php echo $value["note"]; ?></p>
                            </div>
                        </a><a href="removeMark.php?m=<?php echo $value["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
                        </a></li>

                        <?php
                    }
                }
                else{

                    if(isset($recentMarks["url"])){
                        $scheme = parse_url($recentMarks["url"], PHP_URL_SCHEME);
                        $host = parse_url($recentMarks["url"], PHP_URL_HOST);
                        $theURL = $scheme . "://" . $host;

                        $catTitle = $userTools->getCatTitle($recentMarks["category"], $user->id);
                        ?>

                        <li><a href="<?php echo htmlentities($recentMarks["url"]);?>">
                            <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL;?>" />
                            <div class="desc">
                                <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                <p class="addLeftMargin rightSide"><?php echo $catTitle["title"]; ?></p>
                                <p class="addLeftMargin note"><?php echo $recentMarks["note"]; ?></p>
                            </div>
                        </a><a href="removeMark.php?m=<?php echo $recentMarks["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
                        </a></li>


                        <?php

                    }

                    else{
                        ?>

                        <li><a href="#add">
                            <img src="images/default.png" />
                            <h3 class="addLeftMargin">None</h3>
                            <p class="addLeftMargin">Add a New Bookmark</p>
                        </a></li>



                        <?php
                    }
                }


                ?>



            </ul>
        </div><!--/content-primary -->



    </div><!-- /content -->

    <div data-role="footer" data-id="tabs" data-position="fixed">
        <div data-role="navbar">
            <ul>
                <li><a href="#" class="ui-btn-active ui-state-persist">Recent</a></li>
                <li><a href="#categories" data-transition="flow" >Categories</a></li>
                <li><a href="#add" data-rel="dialog" data-transition="flip">Add</a></li>
                <li><a href="logout.php" data-ajax="false">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
    </div>

</div><!-- /page -->

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////START OF CATEGORIES PAGE////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->

<!-- Start of second page -->
<div data-role="page" id="categories">

    <div data-role="header" data-position="fixed">
        <h1>Categories</h1>

    </div><!-- /header -->

    <div data-role="content">

        <div class="content-primary">

            <ul data-role="listview" data-split-icon="delete" data-split-theme="d">

                <?php
                if (isset($cat[0])) {

                    foreach ($cat as $key => $value)
                    {

                        $catCount = $userTools->getCategoryCount( htmlentities($value["id"]), $user->id);
                        $marks = $userTools->getBookmarks($value["id"], $user->id);

                        ?>

                        <li data-role="list-divider"><?php echo htmlentities($value["title"])?><span class="ui-li-count">
                        <?php echo $catCount["total"];?>
                        </span><span class="ui-icon ui-icon-plus ui-icon-shadow" ><a href="removeCat.php?c=<?php echo $value["id"];?>" data-ajax="false">Delete</a></span></li>

                        <?php

                        if(isset($marks[0])) {

                            foreach ($marks as $key => $value2)
                            {
                                $scheme = parse_url($value2["url"], PHP_URL_SCHEME);
                                $host = parse_url($value2["url"], PHP_URL_HOST);
                                $theURL2 = $scheme . "://" . $host;

                                ?>

                                <li><a href="<?php echo htmlentities($value2["url"]);?>">
                                    <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL2;?>" />
                                    <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                    <p class="addLeftMargin note"><?php echo $value2["note"]; ?></p>
                                </a><a href="removeMark.php?m=<?php echo $value2["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
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

                                ?>

                                <li><a href="<?php echo htmlentities($marks["url"]);?>">
                                    <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL2;?>" />
                                    <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                    <p class="addLeftMargin note"><?php echo $marks["note"]; ?></p>
                                </a><a href="removeMark.php?m=<?php echo $marks["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
                                </a></li>
                                <?php

                            }

                            else{
                                ?>
                                <li><a href="#add" data-rel="dialog" data-transition="flip">
                                    <h3 class="addLeftMargin">Empty Category</h3>
                                    <p class="addLeftMargin note">Add A Bookmark</p>
                                </a></li>
                                <?php
                            }
                        }


                    }
                }
                else
                {
                    if (isset($cat["id"])) {

                        $catCount = $userTools->getCategoryCount( htmlentities($cat["id"]), $user->id);
                        $marks = $userTools->getBookmarks($cat["id"], $user->id);

                        ?>

                        <li data-role="list-divider"><?php echo htmlentities($cat["title"])?><span class="ui-li-count">
                        <?php echo $catCount["total"];?>
                    </span><span class="ui-icon ui-icon-plus ui-icon-shadow" ><a href="removeCat.php?c=<?php echo $cat["id"];?>" data-ajax="false">Delete</a></span></li>

                        <?php

                        if(isset($marks[0])) {

                            foreach ($marks as $key => $value2)
                            {
                                $scheme = parse_url($value2["url"], PHP_URL_SCHEME);
                                $host = parse_url($value2["url"], PHP_URL_HOST);
                                $theURL2 = $scheme . "://" . $host;

                                ?>

                                <li><a href="<?php echo htmlentities($value2["url"]);?>">
                                    <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL2;?>" />
                                    <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                    <p class="addLeftMargin note"><?php echo $value2["note"]; ?></p>
                                </a><a href="removeMark.php?m=<?php echo $value2["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
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

                                ?>

                                <li><a href="<?php echo htmlentities($marks["url"]);?>">
                                    <img src="http://immediatenet.com/t/l?Size=800x600&URL=<?php echo $theURL2;?>" />
                                    <h3 class="addLeftMargin"><?php echo $host;?></h3>
                                    <p class="addLeftMargin note"><?php echo $marks["note"]; ?></p>
                                </a><a href="removeMark.php?m=<?php echo $marks["id"]; ?>" data-transition="slideup" data-ajax="false">Delete
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
                    }
                    else {
                        ?>
                        <li>No Categories</li>
                        <?php
                    }
                }
                ?>

            </ul>

        </div>

    </div><!-- /content -->

    <div data-role="footer" data-id="tabs" data-position="fixed">
        <div data-role="navbar">
            <ul>
                <li><a href="#home" data-transition="flow">Recent</a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist">Categories</a></li>
                <li><a href="#add" data-rel="dialog" data-transition="flip">Add</a></li>
                <li><a href="logout.php" data-ajax="false">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
    </div>
</div><!-- /page -->


<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////START OF ADD PAGE////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->
<div data-role="page" id="add">

    <div data-role="header">
        <h1>Add</h1>
    </div><!-- /header -->

    <div data-role="content">
        <form id="formMarks" class="validate" name="addBookmarkForm" method="post" data-ajax="false">
            <h2>Add Bookmark</h2>

            <p>Enter the URL and choose a category.</p>
            <p class="smallText">Or you can add a new Category.</p>
            <p class="smallText">You can also add a note with your bookmark to remind you why you saved it.</p>

            <div data-role="fieldcontain">
                <label for="url">Save URL:</label>
                <input class="required" type="text" name="url" id="url" value=""  />

                <?php
                if(!empty($errorMark)){
                    echo "<p class='error'>". $errorMark ."</p>";
                }

                ?>


                <!--            <input type="button" onClick="PasteFromClipboard()" value="Paste" />-->


                <label for="select_choice_a" class="select">In Category:</label>
                <select class="required" name="select_choice_a" id="select_choice_a" data-native-menu="false">
                    <option>Categories</option>
                    <?php
                    if (isset($cat[0])) {
                        foreach ($cat as $key => $value)
                        {
                            echo "<option value=\"" . htmlentities($value["id"]) . "\">" . htmlentities($value["title"]) . "</option>";
                        }
                    }

                    else{
                        echo "<option value=\"" . htmlentities($cat["id"]) . "\">" . htmlentities($cat["title"]) . "</option>";
                    }

                    ?>
                </select>


                <label for="cat">Or Add New:</label>
                <input type="text" name="cat" id="cat" value=""  />

                <label for="note">Note:</label>
                <input type="text" name="note" id="note" value=""  />
                <input type="hidden" value="<?php echo $user->id; ?>" name="owner"/>
                <button type="submit" name="submit-form2" >Save</button>
            </div>

        </form>
        <!--
        <div class="content-primary">
            <form id="formCat" method="post" class="validate" data-ajax="false">

                <h2>Add Category</h2>

                <p>Enter a title for your new category.</p>

                <div data-role="fieldcontain">
                    <label for="title">Title:</label>
                    <input type="text" class="required" name="title" id="title" />
                    <input type="hidden" value="<?php //echo $user->id; ?>" name="owner"/>
                    <button type="submit" name="submit-form3"  >Add</button>
                </div>
            </form>

        </div>
-->
    </div><!-- /content -->

    <div data-role="footer">
        <h4>MarkCloud</h4>
    </div>

</div><!-- /page -->

</body>
</html>