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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>

<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/jquery.hoverIntent.minified.js"></script>

<script type="text/javascript" src="scripts/sherpa_ui.js"></script>

</head>

<body>
	<div id="wrapper" class="container_16">
		<div id="top_nav" class="nav_down bar_nav grid_16 round_all">
			<ul class="round_all clearfix">
				<li><a class="round_left" href="#">
					<img src="images/icons/grey/admin_user.png">
					Home</a>
				</li> 
                <li><a href="#">
					<img src="images/icons/grey/chart_6.png">
					Latest
					<span class="icon">&nbsp;</span></a>
					<ul>
						<li><a href="#">North America</a></li>
						<li><a href="#">Asia</a></li>
					</ul>
				</li>	
				<li><a href="#">
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
				<li class="send_right"><a class="round_right" href="#">
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
				<li class="send_right"><a href="#">
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
        
        
        
        
        
        <!--<div id="side_nav" class="side_nav small">
            
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
         </div>-->
        
        
			

		
		<div id="main" class="grid_13 omega">
			<div class="content round_all clearfix">
            
         		   <?php
				   
						if($error != "")
						{
   							 echo $error."<br/>";
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
                        <?php
                        }
						?>
                        
          
			</div>
		</div>
		<div class="clear"></div>
		<div id="footer_wrapper" class=" closed container_16">
			<div id="footer" class="grid_16 nav_up bar_nav round_all clearfix">
			<a href="#" class="minimize round_bottom"><span>minimize</span></a>
				<ul class="round_all clearfix">

					<li><a class="round_left" href="#">
						<img src="images/icons/grey/admin_user.png">
						Home</a>
					</li> 

					<li><a href="#">
						<img src="images/icons/grey/settings_2.png">
						Slide
						<span class="icon">&nbsp;</span></a>
						<ul>
							<li><a href="#">North America</a></li>
							<li><a href="#">Europe
								<span class="icon">&nbsp;</span></a>	
								<ul>
									<li><a href="#">
										<img src="images/icons/grey/sign_post.png">Eastern</a></li>
									<li><a href="#">
										<img src="images/icons/grey/strategy_2.png">Central</a></li>
									<li><a href="#">
										<img src="images/icons/grey/refresh_2.png">Western	
										<span class="icon">&nbsp;</span></a>	
										<ul>
											<li><a href="#">
												<img src="images/icons/grey/post_card.png">Germany</a>
											</li>
											<li><a href="#">
												<img src="images/icons/grey/speech_bubble.png">Netherlands</a></li>
											<li><a href="#">
												<img src="images/icons/grey/tags_2.png">France
												<span class="icon">&nbsp;</span></a>							
												<ul>
													<li><a href="#">Paris</a></li>
													<li><a href="#">Lyon</a></li>
													<li><a href="#">Marseille</a></li>
													<li><a href="#">Toulouse</a></li>
												</ul>					
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#">Asia</a></li>
						</ul>
					</li>

					<li><a href="#">
						<img src="images/icons/grey/Battery.png">
						Accordion
						<span class="icon">&nbsp;</span></a> 														
						<ul>
							<li><a href="#">
								<img src="images/icons/grey/zip_file.png">Fruits
								<span class="icon">&nbsp;</span></a>
								<div class="accordion">
									<a href="#">Apples</a>
									<a href="#">Oranges</a>
									<a href="#">Bananas</a>
								</div>	
							</li>
							<li class="link"><a href="http://en.wikipedia.org/wiki/Bread">
								<img src="images/icons/grey/winner_podium.png">Breads</a>
							</li>
							<li><a href="#">
								<img src="images/icons/grey/sport_shirt.png">Vegetables
								<span class="icon">&nbsp;</span></a>
								<div class="accordion">
									<a href="#">Potatoes</a>
									<a href="#">Spinach</a>
									<a href="#">Celery</a>
								</div>	
							</li>
							<li><a href="#">
								<img src="images/icons/grey/trashcan_2.png">Meat
								<span class="icon">&nbsp;</span></a>
								<div class="accordion">
									<a href="#">Beef</a>
									<a href="#">Pork</a>
									<a href="#">Venison</a>
								</div>	
							</li>
						</ul>					
					</li>

					<li class="has_mega_menu"><a href="#">
						<img src="images/icons/grey/Chrome.png">
						Mega Menu
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

					<li><a href="#">
						<img src="images/icons/grey/chart_6.png">
						Mixed
						<span class="icon">&nbsp;</span></a>
						<ul>
							<li><a href="#">North America
								<span class="icon">&nbsp;</span></a>
								<div class="accordion">
									<a href="#">Paris</a>
									<a href="#">Lyon</a>
									<a href="#">Marseille</a>
									<a href="#">Toulouse</a>
								</div>
							</li>
							<li><a href="#">Europe
								<span class="icon">&nbsp;</span></a>	
								<ul>
									<li><a href="#">Eastern</a></li>
									<li><a href="#">Central</a></li>
									<li><a href="#">Western
										<span class="icon">&nbsp;</span></a>			
										<ul>
											<li><a href="#">Germany
												<span class="left icon">&nbsp;</span></a>									
												<ul class="slide_left">
													<li><a href="#">Berlin</a></li>
													<li><a href="#">Munich</a></li>
													<li><a href="#">Frankfurt</a></li>
												</ul>
											</li>
											<li><a href="#">Netherlands</a></li>
											<li><a href="#">France
												<span class="left icon">&nbsp;</span></a>									
												<div class="accordion">
													<a href="#">Paris</a>
													<a href="#">Lyon</a>
													<a href="#">Marseille</a>
													<a href="#">Toulouse</a>
												</div>					
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#">Asia</a></li>
						</ul>
					</li>

					<li><a href="#">
						<img src="images/icons/grey/Book.png">
						Link</a>
					</li>

					<li class="send_right"><a class="round_right" href="#">
						<img src="images/icons/grey/magnifying_glass.png">
						Search
						<span class="icon">&nbsp;</span></a>
						<div class="drop_box right round_all">
							<form style="width:210px">
								<input class="round_all" value="Search...">
								<button class="send_right">Go</button>
							</form>
						</div>
					</li>

					<li class="send_right"><a href="#">
						<img src="images/icons/grey/Key.png">
						Login
						<span class="icon">&nbsp;</span></a>
						<div class="drop_box right round_all">
							<form style="width:160px">
								<fieldset class="grid_8">
									<label>Email</label><input class="round_all" value="name@example.com">
								</fieldset>
								<fieldset class="grid_8">
									<label>Password</label><input class="round_all" type="password" value="password">
								</fieldset>
								<button class="send_right">Login</button>
							</form>
						</div>
					</li>

				</ul>
			</div>
		</div>
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