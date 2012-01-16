<?php

echo checkURL("www.google.com");



function checkURL($url)
       {
		  			   
       		  $domain = correctURL($url);
			  
			  if (strstr($domain, "http://") == $domain || strstr($domain, "ftp://") == $domain) { 
		  			$checkedURL = $domain;
		  		}
		 	 else {
				  $domain = "http://" . $domain;
				  $checkedURL = $domain;
		 	 }
			  
			  if($checkedURL != FALSE){
			     
               //check, if a valid url is provided
               if(!filter_var($checkedURL, FILTER_VALIDATE_URL))
               {
                       return false;
               }

               //initialize curl
               $curlInit = curl_init($checkedURL);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //get answer
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
			  }
			  
			  else{
				  return false;
			  }
       }
	   
	   
	   
	   ////////////////////////////////////////////////////////////////
	function correctURL($address)
{
    if (!empty($address) AND $address{0} != '#' AND
    strpos(strtolower($address), 'mailto:') === FALSE AND
    strpos(strtolower($address), 'javascript:') === FALSE)
    {
        $address = explode('/', $address);
        $keys = array_keys($address, '..');

        foreach($keys AS $keypos => $key)
            array_splice($address, $key - ($keypos * 2 + 1), 2);

        $address = implode('/', $address);
        $address = str_replace('./', '', $address);
       
        $scheme = parse_url($address);
       
        if (empty($scheme['scheme']))
            $address = 'http://' . $address;

        $parts = parse_url($address);
        $address = strtolower($parts['scheme']) . '://';

        if (!empty($parts['user']))
        {
            $address .= $parts['user'];

            if (!empty($parts['pass']))
                $address .= ':' . $parts['pass'];

            $address .= '@';
        }

        if (!empty($parts['host']))
        {
            $host = str_replace(',', '.', strtolower($parts['host']));

            if (strpos(ltrim($host, 'www.'), '.') === FALSE)
                $host .= '.com';

            $address .= $host;
        }

        if (!empty($parts['port']))
            $address .= ':' . $parts['port'];

        $address .= '/';

        if (!empty($parts['path']))
        {
            $path = trim($parts['path'], ' /\\');

            if (!empty($path) AND strpos($path, '.') === FALSE)
                $path .= '/';
               
            $address .= $path;
        }

        if (!empty($parts['query']))
            $address .= '?' . $parts['query'];

        return $address;
    }

    else
        return FALSE;
}

	
	
?>