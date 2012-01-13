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

?>