<?php

require_once 'includes/global.inc.php';

if(!isset($_SESSION['logged_in'])) {
	header("Location: index.php");
}

else{
	
$user = unserialize($_SESSION['user']);

$title = "";
$error2 = "";
$url = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form3'])) { 

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
	    //header("Location: index.php");
	    
	}

}

if(isset($_POST['submit-form2'])) { 

	//retrieve the $_POST variables
	$url = $_POST['url'];
	$owner = $_POST['owner'];
	$cat = $_POST['pickCat'];
	
	//initialize variables for form validation
	$userTools = new UserTools();
	$success = $userTools->checkURL($url);
	
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
	    //header("Location: home.php");
	    
	}
	else
	{
		echo "URL doesnt exist";
	}
}

$cat = $userTools->getCategories($user->id);


if(isset($_POST['categoryList'])) { 

$theCat = $userTools->getCategory($_POST['categoryList']);
$selectedCat = $theCat->title;
$selectedCatIndex = $theCat->id;

}

else{
//	if (isset($cat["title"])){
//		$selectedCat = $cat["title"];
//		$selectedCatIndex = $cat["id"];
//	}
//	else{
//		$selectedCat = "NONE";
//		$selectedCatIndex = "NONE";
//	}

$marks = $userTools->getRecentBookmarks(18, $user->id);
$marks2 = $userTools->getRecentBookmarks(25, $user->id);

}

if (isset($selectedCatIndex)){
	//$marks = $userTools->getBookmarks($selectedCatIndex, $user->id);
	$marks = $userTools->getRecentBookmarks(18, $user->id);
	$marks2 = $userTools->getRecentBookmarks(25, $user->id);
}

//function isAssoc($arr)
//{
//    return array_keys($arr) !== range(0, count($arr) - 1);
//}

}
//////////////////////////////////




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" /> 

<title>MyProjectApp</title>

<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/text.css" />
<link rel="stylesheet" href="styles/960_fluid.css" />
<link rel="stylesheet" href="styles/main.css" />
<link rel="stylesheet" href="styles/bar_nav.css" />
<link rel="stylesheet" href="styles/side_nav.css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
-->
<script src="scripts/jquery.masonry.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>

<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/jquery.hoverIntent.minified.js"></script>

<script type="text/javascript" src="scripts/sherpa_ui.js"></script>

<script>
function hideFirst()
{
	first.style.display = "none";
}
</script>

</head>

<body>
	<div id="wrapper" class="">
		<div id="top_nav" class="nav_down bar_nav round_all">
          <a href="#" class="minimize round_bottom"><span>minimize</span></a>
			<ul class="round_all clearfix">
				<li id="home"><a class="round_left" href="#">
					<img src="images/icons/grey/admin_user.png">
					Home</a>
				</li> 
                
                
                
                
                
                <?php 				
if(isset($marks[0])) {
	
	?>
    <li id="latest"><a href="#">
					<img src="images/icons/grey/chart_6.png">
					Latest
					<span class="icon">&nbsp;</span></a>
					<ul id="recentList">
                    <?php
					foreach ($marks2 as $key => $value) 
					{
						$url = parse_url(htmlentities($value["url"]), PHP_URL_HOST);
					?>
                    
					
                    <li><a href="<?php htmlentities($value["url"]);?>"><img id="favi" src="<?php echo 'http://www.google.com/s2/favicons?domain=' . $url; ?>"><span id="recentURL"><?php echo $url ;?></span></a></li>
                    <?php
					}
					?>
					</ul>
				</li>
    <?php


}
else{
	
	if(isset($marks["url"])){
		
		?>
        
		<li id="latest"><a href="#">
					<img src="images/icons/grey/chart_6.png">
					Latest
					<span class="icon">&nbsp;</span></a>
					<ul id="recentList">
                   <?php
						$url = parse_url($marks["url"], PHP_URL_HOST);
					?>
                    <li><a href="<img id="favi" src="<?php echo 'http://www.google.com/s2/favicons?domain=' . $url; ?>"><?php $marks["url"];?>"><span id="recentURL"><?php echo $url;?></span></a></li>
					</ul>
				</li>
		
		<?php
		
	}
	
	else{
		
	}
}


?> 

                
                
                
				<li><a class="round_left2" href="#">
<!--					<img src="images/icons/grey/settings_2.png">
-->	
					<img src="images/icons/grey/Book.png">

					Bookmarks
					<span class="icon">&nbsp;</span></a>
                    <ul>
                                      <?php 				
if(isset($cat[0])) {
	

	foreach ($cat as $key => $value) :
	
		?>
        <li><a href="#"><?php echo $value["title"];?></a>
       	 <span class="icon">&nbsp;</span>
       	 <div class="accordion">
         
         
         <?php 				
if(isset($marks[0])) {
					foreach ($marks2 as $key => $value) :
					
					?>
                    <a href="<?php htmlentities($value["url"])?>"><?php htmlentities($value["url"])?></a>				

                    <?php endforeach; ?>
    <?php


}
else{
	
	if(isset($marks["url"])){
		
		?>
        <a href="<?php $marks["url"]?>"><?php $marks["url"]?></a>
	
		<?php
		
	}
	
	else{
		
	}
}
		
		?>
        </div>
		</li>
        <?php
endforeach; 

}
else{
	
	if(isset($cat["title"])){
		
		?>
        <li><a href="#"><?php echo $cat["title"];?></a>
       	 <span class="icon">&nbsp;</span>
       	 <div class="accordion">
         
       	 <a href="http://www.google.ie"></a>
         
   		 </div>
		</li>
        <?php
		
	}
	
	else{
		
	}
}


?>
					</ul>
				</li>
                <li class="send_right" id=""><a class="round_right" href="logout.php">
					<img src="images/icons/grey/Clipboard.png">
					Logout</a>
				</li>
                <li class="send_right has_mega_menu"><a href="#">
						<img src="images/icons/grey/Paperclip.png">
						Add
						<span class="icon">&nbsp;</span></a>
						<div class="mega_menu container_16"> 
							<div class="grid_8"> 
							xvxvvx
							</div> 
							<div class="grid_4"> 
								<h4>Add Category</h4> 
                                <?php echo ($error2 != "") ? $error2 : ""; ?>
                                <form method="post">
                                  Title:
                                  <input type="text" value="<?php echo $title; ?>" name="title" />
                                  <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
                                  
                                  <input type="submit" value="Add" name="submit-form3" />
                                </form>
</div>
                            <div class="grid_4">
                            <?php 
							
							
							
							
							if(isset($cat[0])) {
 ?>
                            <h4>Add Bookmark</h4>
                            <form name="addBookmarkForm"  method="post">
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
                                <input type="submit" value="Save" name="submit-form2" />
                              </form>
                            <?php 
								}
							

else{
	
	if(isset($cat["title"])){
		?>
                            <h4>Add Bookmark</h4>
                            <form name="addBookmarkForm"  method="post">
                                Save URL:
                                <input type="text" value="<?php echo $url; ?>" name="url" />
                                In:
                                <select name="pickCat" id="pickCat" onClick="hideFirst()" >
                                <?php   
                                    echo "<option value=\"" . htmlentities($cat["id"]) . "\">" . htmlentities($cat["title"]) . "</option>";
                                ?>
                              </select>
                                <input type="hidden" value="<?php echo $user->id; ?>" name="owner" />
                                <input type="submit" value="Save" name="submit-form2" />
                              </form>
                            <?php
	}
	
	else{
		?>
                            <p>You Dont Have Any Categories Yet!</p>
                            <?php
	}
}
			
							?>
                          </div> 
						</div> 
					</li>					
			</ul>
		</div>
        
        
        
        		<div class="clear"></div>

        
        <div id="side_nav" class="side_nav small">
            <div id="colour_switcher" class="rightSide switcher">
					<a id="blue" href="#"><span>Blue</span></a>
					<a id="red" href="#"><span>Red</span></a>
					<a id="green" href="#"><span>Green</span></a>
					<a id="cyan" href="#"><span>Cyan</span></a>
					<a id="orange" href="#"><span>Orange</span></a>
					<a id="pink" href="#"><span>Pink</span></a>
					<a id="purple" href="#"><span>Purple</span></a>
					<a id="navy" href="#"><span>Navy</span></a>
					<a id="brown" href="#"><span>Brown</span></a>
                    <a id="default" href="#"><span>Default</span></a>
			</div>
            <div id="bg_switcher" class="switcher">
					<a id="hatch" href="images/bg_hatch_grey_dark.jpg"><span>Hatch</span></a>
					<a id="ash" href="images/bg_ash.jpg"><span>Ash</span></a>
					<a id="brown_noise" href="images/bg_diag_wood.jpg"><span>Brown Noise</span></a>
					<a id="dark_wood" href="images/bg_dark_wood.jpg"><span>Dark Wood</span></a>
					<a id="holes" href="images/bg_holes.png"><span>Holes</span></a>
					<a id="honeycomb" href="images/bg_honeycomb.png"><span>Honeycomb</span></a>
					<a id="noise" href="images/bg_noise.png"><span>Noise</span></a>
					<a id="punched" href="images/bg_punched.png"><span>Punched</span></a>
					<a id="silver_noise" href="images/bg_silver_noise_grey.jpg"><span>Silver</span></a>
					<a id="squares" href="images/bg_squares.png"><span>Squares</span></a>
					<a id="wood" href="images/bg_wood.jpg"><span>Wood</span></a>
                </div>
            <a href="#" class="minimize round_right"><span>minimize</span></a>
         </div>
        
        
			

				<div class="clear"></div>

        
        		        <div id="container" class="clearfix">
                        
                               <?php 				
if(isset($marks[0])) {
	

foreach ($marks as $key => $value) 
	{
		?>
          <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                   <a target="_blank" href="<?php echo htmlentities($value["url"]);?>">
                   <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo htmlentities($value["url"]);?>" /> </a> 

			</div>
		</div>
        <?php
	}
}
else{
	
	if(isset($marks["url"])){
		?>
          <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                   <a target="_blank" href="<?php echo $marks["url"];?>">
                   <img src="http://immediatenet.com/t/fs?Size=800x600&URL=<?php echo $marks["url"];?>" /> </a> 

			</div>
		</div>
        <?php
		
	}
	
	else{
		?>
          <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                   <a target="_blank" href="http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html">
                   <img src="http://immediatenet.com/t/fs?Size=800x600&URL=http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html" /> </a> 

			</div>
		</div>
        <?php
	}
}


?> 

      
        
    </div>
    
    
        </div>
		<div class="clear"></div>
       
        


<script>
  $(function(){
    
    $('#container').masonry({
      itemSelector: '.box',
      isAnimated: true
    });
    
  });
</script>
		
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4548504-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>