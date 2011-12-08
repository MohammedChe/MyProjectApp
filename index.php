<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="text/javascript">
function showRSS(str)
{
if (str.length==0)
  { 
  document.getElementById("rssOutput").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getrss.php?q="+str,true);
xmlhttp.send();
}
</script>
<title>Orchesta Hosted Sample RSS Reader</title>
</head>
	
<body>
<h1>Orchestra-Hosted Sample RSS Reader</h1>

<form>
<select onchange="showRSS(this.value)">
<option value="">Select an RSS-feed:</option>
<option value="TeamworkPM">TeamworkPM</option>
<option value="OnePageCRM">OnePageCRM</option>
<option value="Allmoto">Allmoto</option>
<option value="Intercom">Intercom</option>
</select>
</form>
    
<br />
<h2>Check out their RSS feed here: </h2>
<div id="rssOutput"></div>
</body>
</html>