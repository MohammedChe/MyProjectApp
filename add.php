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

    $title = "";
    $errorCat = "";
    $errorMark = "";
    $url = "";

    //check to see that the form has been submitted
    if (isset($_POST['submit-form3'])) {

        //retrieve the $_POST variables
        $title = $_POST['title'];
        $owner = $_POST['owner'];

        //initialize variables for form validation
        if(empty($title)){
            $success = false;
            $errorCat = "The title is empty!!";
        }

        else{
            $success = true;
        }

        $userTools = new UserTools();

        if ($success) {
            //prep the data for saving in a new user object
            $data['title'] = $title;
            $data['owner'] = $owner;
            //create the new user object
            $newCat = new Category($data);

            //save the new user to the database
            $newCat->save(true);

            //redirect them to a welcome page
            header('Location: index.php');
            exit;
        }

    }

    if (isset($_POST['submit-form2'])) {

        //retrieve the $_POST variables
        $url = $_POST['url'];
        $owner = $_POST['owner'];
        $cat = $_POST['select-choice-a'];
        $note = $_POST['note'];

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
            header('Location: index.php');
            exit;

        }
        else
        {
            echo "URL doesnt exist";
        }
    }


    $cat = $userTools->getCategories($user->id);

//    $recentMarks = $userTools->getRecentBookmarks(12, $user->id);

}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>MyProjectApp|Add</title>

    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <link rel="stylesheet" href="styles/mobile.css" />


</head>
<body>


<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////START OF ADD PAGE////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->
<div data-role="page" id="add">
    <!--    <script type="text/javascript">-->
    <!---->
    <!--        function PasteFromClipboard()-->
    <!---->
    <!--        {-->
    <!---->
    <!--            document.addBookmarkForm.url.focus();-->
    <!---->
    <!--            PastedText = document.addBookmarkForm.url.createTextRange();-->
    <!---->
    <!--            PastedText.execCommand("Paste");-->
    <!---->
    <!--        }-->
    <!---->
    <!--    </script>-->


    <div data-role="header">
        <h1>Add</h1>
    </div><!-- /header -->

    <div data-role="content">

        <div class="content-secondary">
            <form name="addBookmarkForm" method="post" data-ajax="false">

                <h2>Add Bookmark</h2>

                <p>Enter the URL and choose a category.</p>
                <p class="smallText">You can add a note with your bookmark to remind you why you saved it.</p>

                <div data-role="fieldcontain">
                    <label for="url">Save URL:</label>
                    <input type="text" name="url" id="url" value=""  />

                    <!--            <input type="button" onClick="PasteFromClipboard()" value="Paste" />-->


                    <label for="select-choice-a" class="select">In:</label>
                    <select name="select-choice-a" id="select-choice-a" data-native-menu="false">
                        <option>Categories</option>
                        <?php
                        foreach ($cat as $key => $value)
                        {
                            echo "<option value=\"" . htmlentities($value["id"]) . "\">" . htmlentities($value["title"]) . "</option>";
                        }

                        ?>
                    </select>
                    <label for="note">Note:</label>
                    <input type="text" name="note" id="note" value=""  />
                    <input type="hidden" value="<?php echo $user->id; ?>" name="owner"/>
                    <button type="submit" name="submit-form2" >Save</button>
                </div>

            </form>
        </div>
        <div class="content-primary">
            <form method="post" data-ajax="false">

                <h2>Add Category</h2>

                <p>Enter a title for your new category.</p>
                <p class="smallText">Or skip this and add a bookmark to an existing category.</p>

                <?php
                if(!empty($errorCat)){
                    echo "<p class='error'>". $errorCat ."</p>";

                    ?>
                    <script>
                        $.mobile.changePage($("#add:jqmData(role='dialog')"), {transition : "flip"});
                    </script>

                    <?php
                }

                ?>

                <div data-role="fieldcontain">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value=""  />
                    <input type="hidden" value="<?php echo $user->id; ?>" name="owner"/>
                    <button type="submit" name="submit-form3" >Add</button>
                </div>
            </form>

        </div>

    </div><!-- /content -->

    <div data-role="footer">
        <h4>MyProjectApp|MohammedChe</h4>
    </div>

</div><!-- /page -->

</body>
</html>