<?php

require_once 'includes/global.inc.php';

if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
$user = unserialize($_SESSION['user']);
$cat = $userTools->getCategories($user->id);
$redCat = "recent";

if(isset($_POST['c'])) {
	$redCat = mysql_real_escape_string($_POST['c']);
}

if($redCat != "recent") { 

$theCat = $userTools->getCategory($redCat);
$selectedCatIndex = $theCat->id;
$selectedCat = $theCat->title;

}

else{
	
	if (isset($cat["title"])){
		$selectedCatIndex = $cat["id"];
		$selectedCat = $cat["id"];
		$redCat = $selectedCatIndex;
	}
	else{
		$marks = $userTools->getRecentBookmarks(18, $user->id);
		$redCat = "recent";
		$selectedCat = "Recent";
	}
}

if (isset($selectedCatIndex)){
	$marks = $userTools->getBookmarks($selectedCatIndex, $user->id);
}

}
//////////////////////////////////

				
if(isset($marks[0])) {
	

foreach ($marks as $key => $value) 
	{
		$scheme = parse_url($value["url"], PHP_URL_SCHEME);
		$host = parse_url($value["url"], PHP_URL_HOST);
		$theURL2 = $scheme . "://" . $host;
		?>
          <div id="main" class="box grid_4">
			<div class="imgHover content round_all clearfix">
           <div class="hover"><a onClick="removeMark(<?php echo htmlentities($value["id"])?>,'<?php echo $redCat?>','<?php echo $selectedCat ?>');" href="#"><img src="images/close.png" title="Remove Bookmark" alt="Remove" /></a></div>
                   <a target="_blank" href="<?php echo htmlentities($value["url"]);?>">
                   <img class="screenshot" src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL2;?>" /> </a> 

			</div>
		</div>
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
          <div id="main" class="box grid_4">
			<div class="imgHover content round_all clearfix">
           <div class="hover"><a onClick="removeMark(<?php echo $marks["id"]?>,'<?php echo $redCat?>','<?php echo $selectedCat?>');" href="#"><img src="images/close.png" title="Remove Bookmark" alt="Remove" /></a></div>
                   <a target="_blank" href="<?php echo $marks["url"];?>">
                   <img class="screenshot" src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $theURL2;?>" /> </a> 

			</div>
		</div>
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