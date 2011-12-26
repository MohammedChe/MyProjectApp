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

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
<title>Categories</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body>

<?php 
$cat = $userTools->getCategories($user->id);
?>
<form name="form" id="form">
  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
<?php 
  
foreach ($cat as $key => $value) 
{
    echo "<option value=$value[title]>$value[title]</option>";
}

?>
       
  </select>
</form>
<?php echo ($error != "") ? $error : ""; ?>
<form action="home.php" method="post">
  Title:
  <input type="text" value="<?php echo $title; ?>" name="title" />
  <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
  <br/>
  <input type="submit" value="Add" name="submit-form" />
</form>
<?php echo $cat[1]['title']; ?>
<br />
<?php 

foreach ($cat as $key => $value) 
{
    echo "Key: $key; Value: $value[title]<br />\n";
}

echo ""; print_r($cat); echo "";
?>
</body>
</html>