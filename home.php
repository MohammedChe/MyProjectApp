<?php 
//register.php

require_once 'includes/global.inc.php';

if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

//initialize php variables used in the form
$title = "";
$error = "";
$url = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

	//retrieve the $_POST variables
	$title = $_POST['title'];
	$owner = $_POST['owner'];
	
	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();
	
	if($success)
	{
	    //prep the data for saving in a new user object
	    $data['title'] = $title;
		$data['owner'] = $owner;
	    //create the new user object
	    $newCat = new Category($data);
	
	    //save the new user to the database
	    $newCat->save(true);
	
	    //redirect them to a welcome page
	    header("Location: home.php");
	    
	}

}

if(isset($_POST['submit-form2'])) { 

	//retrieve the $_POST variables
	$url = $_POST['url'];
	$owner = $_POST['owner'];
	$cat = $_POST['pickCat'];
	
	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();
	
	if($success)
	{
	    //prep the data for saving in a new user object
	    $data['category'] = $cat;
		$data['owner'] = $owner;
		$data['url'] = $url;
	    //create the new user object
	    $newBookmark = new Bookmark($data);
	
	    //save the new user to the database
	    $newBookmark->save(true);
	
	    //redirect them to a welcome page
	    header("Location: home.php");
	    
	}

}

$cat = $userTools->getCategories($user->id);


if(isset($_POST['categoryList'])) { 

$theCat = $userTools->getCategory($_POST['categoryList']);
$selectedCat = $theCat->title;
$selectedCatIndex = $theCat->id;

}

else{
	if (isset($cat[0])){
		$selectedCat = $cat[0]['title'];
		$selectedCatIndex = $cat[0]['id'];
	}
	else{
		$selectedCat = "NONE";
		$selectedCatIndex = "NONE";
	}
}

$marks = $userTools->getBookmarks($selectedCatIndex, $user->id);

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
<title>Categories</title>
<script>
function hideFirst()
{
	first.style.display = "none";
}
</script>
</head>
<body>

<?php 
if (!isset($cat[0])){
?> 

hdbcjshacjhsdcjsc
<?php 
}
else
{
?>
<form name="categoryForm" id="categoryForm" method="post">
  <select name="categoryList" id="categoryList" onChange="this.form.submit()" onClick="hideFirst()">
  <option id="first" value="$selectedCatIndex"><?php echo $selectedCat ?></option>
<?php 
foreach ($cat as $key => $value) 
{
	echo "<option value=\"" . htmlentities($value["id"]) . "\">" . htmlentities($value["title"]) . "</option>";
}

?>
       
  </select>
</form>
<?php 
}
?>
<?php 
echo "<br /> <br /> $selectedCat <br />";
echo "$selectedCatIndex <br /> <br />";

?>
<?php echo ($error != "") ? $error : ""; ?>
<form action="home.php" method="post">
  Title:
  <input type="text" value="<?php echo $title; ?>" name="title" />
  <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
  <br/>
  <input type="submit" value="Add" name="submit-form" />
</form>
<?php 
//echo ""; print_r($cat); echo "";
?>
<br />
<br />
<form name="addBookmarkForm" action="home.php" method="post">
  Save URL:
  <input type="text" value="<?php echo $url; ?>" name="url" />
  In:
  <select name="pickCat" id="pickCat" onClick="hideFirst()" >
	<?php 
	foreach ($cat as $key => $value) 
	{
		echo "<option value=\"" . htmlentities($value["id"]) . "\">" . htmlentities($value["title"]) . "</option>";
	}

	?>      
  </select>
  <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
  <br/>
  <input type="submit" value="Save" name="submit-form2" />
</form>
<br />
<br />
<br />
<?php 
	foreach ($marks as $key => $value) 
	{
		echo htmlentities($value["url"]);
	}

//echo ""; print_r($marks); echo "";
?>   
<img name="" src="http://images.w3snapshot.com/?url=http://www.google.com&size=L&key=1234567890&format=jpg&quality=80" width="32" height="32" alt="">
</body>
</html>