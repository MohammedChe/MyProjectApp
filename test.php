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

<br />
<br />
<br />
<br />

    <div id="container" class="clearfix">
                        
                        


                              
          <div id="main" class="box grid_4">
			<div class="imgHover content round_all clearfix">
            
           <div class="hover"><a href="#"><img src="images/close.png" title="Remove Bookmark" alt="Remove" /></a></div>

                   <a target="_blank" href="http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html">
                   <img class="screenshot" src="http://immediatenet.com/t/fs?Size=800x600&URL=http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html" /> </a> 

			</div>
		</div>
        
        <div id="main" class="box grid_4">
			<div class="imgHover content round_all clearfix">
            
           <div class="hover"><a href="#"><img src="images/close.png" alt="Remove" /></a></div>

                   <a target="_blank" href="http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html">
                   <img class="screenshot" src="http://immediatenet.com/t/fs?Size=800x600&URL=http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html" /> </a> 

			</div>
		</div>


<div id="main" class="box grid_4">
			<div class="imgHover content round_all clearfix">
            
           <div class="hover"><a href="#"><img src="images/close.png" alt="Remove" /></a></div>

                   <a target="_blank" href="http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html">
                   <img class="screenshot" src="http://immediatenet.com/t/fs?Size=800x600&URL=http://strictlybeats.blogspot.com/2006/11/9th-wonder-instrumental-drop.html" /> </a> 

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
  
  
  $(window).resize(function(){
  $('#catTitle').css({
    left: ($(window).width() - $('#catTitle').outerWidth())/2
  });
});

$(function() {
    $(".imgHover").hover(
        function() {
            $(this).children("img").fadeTo(200, 0.85).end().children(".hover").show();
        },
        function() {
            $(this).children("img").fadeTo(200, 1).end().children(".hover").hide();
        });
});

 
// To initially run the function:
$(window).resize();
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