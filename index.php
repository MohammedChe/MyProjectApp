<?php
//login.php

require_once 'includes/global.inc.php';

$error = "";
$email = "";
$password = "";

//check to see if they've submitted the login form
if(isset($_POST['submit-login'])) { 

	$email = $_POST['email'];
	$password = $_POST['password'];

	$userTools = new UserTools();
	if($userTools->login($email, $password)){ 
		//successful login, redirect them to a page
		header("Location: home.php");
	}else{
		$error = "Incorrect email or password. Please try again.";
	}
}
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
                <li id="latest"><a href="#">
					<img src="images/icons/grey/chart_6.png">
					Latest
					<span class="icon">&nbsp;</span></a>
					<ul>
						<li><a href="#">North America</a></li>
						<li><a href="#">Asia</a></li>
					</ul>
				</li>	
				<li><a class="round_left2" href="#">
<!--					<img src="images/icons/grey/settings_2.png">
-->	
					<img src="images/icons/grey/Book.png">

					Bookmarks
					<span class="icon">&nbsp;</span></a>
                    <ul>
						<li><a href="#">North America</a>
							<span class="icon">&nbsp;</span>
							<div class="accordion">
								<a href="http://www.google.ie">Paris</a>
								<a href="#">Lyon</a>
								<a href="#">Marseille</a>
								<a href="#">Toulouse</a>
							</div>
						</li>
						<li><a href="#">North America</a>
							<span class="icon">&nbsp;</span>
							<div class="accordion">
								<a href="http://www.google.ie">Paris</a>
								<a href="#">Lyon</a>
								<a href="#">Marseille</a>
								<a href="#">Toulouse</a>
							</div>
						</li>
                        <li><a href="#">North America</a>
							<span class="icon">&nbsp;</span>
							<div class="accordion">
								<a href="http://www.google.ie">Paris</a>
								<a href="#">Lyon</a>
								<a href="#">Marseille</a>
								<a href="#">Toulouse</a>
							</div>
						</li>
					</ul>
				</li>
				<li id="search" class="send_right"><a class="round_right" href="#">
					<img src="images/icons/grey/magnifying_glass.png">
					Search
					<span class="icon">&nbsp;</span></a>
					<div class="drop_box right round_all">
						<form style="width:210px">
							<fieldset>
								<input class="round_all" value="Search...">
								<button class="send_right">Go</button>
							</fieldset>
						</form>
					</div>
				</li>				
				<li class="send_right"><a class="round_right2" href="#">
					<img src="images/icons/grey/Key.png">
					Login
					<span class="icon">&nbsp;</span></a>
					<div class="drop_box right round_all">
                    
 
                    <?php
						if($error != "")
						{
   							 echo $error."<br/>";
						}
					?>
						<form  method="post" style="width:160px">
							<fieldset>
								<label>Email</label><input type="text" class="round_all" name="email" value="<?php echo $email; ?>">
							</fieldset>
							<fieldset>
								<label>Password</label><input class="round_all" name="password" type="password" value="<?php echo $password; ?>">
							</fieldset>
							<button  type="submit" class="send_right" name="submit-login">Login</button>
						</form>
					</div>
				</li>
                <li class="send_right has_mega_menu"><a href="#">
						<img src="images/icons/grey/Chrome.png">
						Add
						<span class="icon">&nbsp;</span></a>
						<div class="mega_menu container_16"> 
							<div class="grid_8"> 
								<h2>Welcome to Sherpa Nav System</h2> 
								<p><img class="float_left" src="images/sherpa_crest.jpg" width="132" height="132"><strong>Sherpas</strong> were immeasurably valuable to early explorers of the Himalayan region, serving as guides and porters at the extreme altitudes of the peaks and passes in the region. Today, the term is used casually to refer to almost any guide or porter hired for mountaineering expeditions in the Himalayas.</p>
								<p>In Nepal, however, <strong>Sherpas</strong> insist on making the distinction between themselves and general porters, because <strong>Sherpas</strong> often serve in a more guide-like role and command higher pay and respect from the community.</p>
							</div> 
							<div class="grid_4"> 
								<h4>1/4 Column</h4> 
								<p><strong>Sherpas</strong> are short in stature to accelerate the speed of circulation around the body and also breathe more quickly than the average person to extract more oxygen from the thin air.</p>
							</div> 
							<div class="grid_4"> 
								<h4>1/4 Column</h4> 
								<p><strong>Sherpas</strong> are renowned in the international climbing and mountaineering community for their hardiness, expertise, and experience at high altitudes.</p>
							</div> 
							<div class="grid_8"> 
								<p>It has been speculated that a portion of the <strong>Sherpas</strong>' climbing ability is the result of a genetic adaptation to living in high altitudes. Some of these adaptations include unique hemoglobin-binding enzymes, doubled nitric oxide production, hearts that can utilize glucose, and lungs with an increased efficiency in low oxygen conditions.</p>
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
				   
						if($error != "")
						{
   							 echo $error."<br/>";
					?>
						<div id="main" class="box grid_16">
			<div class="content round_all clearfix">
					
						<form  method="post" style="width:160px">
							<fieldset>
								<label>Email</label><input type="text" class="round_all" name="email" value="<?php echo $email; ?>">
							</fieldset>
							<fieldset>
								<label>Password</label><input class="round_all" name="password" type="password" value="<?php echo $password; ?>">
							</fieldset>
							<button  type="submit" class="send_right" name="submit-login">Login</button>
						</form>
                        	</div>
		</div>
        		<div class="clear"></div>

                        <?php
                        }
						?>
                                                
                        
      

        
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                        <img name="" src="http://immediatenet.com/artwork/top_50_usa.jpg" alt="njkj">
			</div>
		</div>
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                        <img name="" src="http://immediatenet.com/artwork/top_50_usa.jpg" alt="njkj">
			</div>
		</div>
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                        <img name="" src="http://immediatenet.com/artwork/top_50_usa.jpg" alt="njkj">
			</div>
		</div>
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                        <img name="" src="http://immediatenet.com/artwork/top_50_usa.jpg" alt="njkj">
			</div>
		</div>
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                        <img name="" src="http://immediatenet.com/artwork/top_50_usa.jpg" alt="njkj">
			</div>
		</div>
        <div id="main" class="box grid_4">
			<div class="content round_all clearfix">
           
                   <a target="_blank" href="http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html">
                   <img src="http://immediatenet.com/t/fs?Size=800x600&URL=http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html" /> </a> 

			</div>
		</div>
        
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