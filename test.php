<?php

$url = "www.google.com";
if (strstr($url, "http://") == $url || strstr($url, "ftp://") == $url) { 
echo "YES";
echo $url;
}
else {
	echo "NO";
	echo $url;
	$url = "http://" . $url;
	echo $url;
}



function getSiteFavicon($url)
	{
	  $ch = curl_init('http://www.google.com/s2/favicons?domain='.$url);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
	  $data = curl_exec($ch);
	  curl_close($ch);
   
	  header("Content-type: image/png; charset=utf-8");
	  echo $data;
	}
	
	
	getSiteFavicon("http://www.facebook.com");

?>