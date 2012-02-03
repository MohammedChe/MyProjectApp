<?php
require_once 'User.class.php';
require_once 'DB.class.php';

class UserTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function login($email, $password)
	{

		$hashedPassword = md5($password);
		$result = mysql_query("SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'");

		if(mysql_num_rows($result) == 1)
		{
			$_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}else{
			return false;
		}
	}
	
	//Log the user out. Destroy the session variables.
	public function logout() {
		unset($_SESSION["user"]);
		unset($_SESSION["login_time"]);
		unset($_SESSION["logged_in"]);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkEmailExists($email) {
		$result = mysql_query("select id from users where email='$email'");
    	if(mysql_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	public function get($id)
	{
		$db = new DB();
		$result = $db->select('users', "id = $id");
		
		return new User($result);
	}
	
	public function getCategories($owner)
	{
		$db = new DB();
		$result = $db->select('category', "owner = $owner");

		return $result;
	}
	
	
	public function getCategory($id)
	{
		$db = new DB();
		$result = $db->select('category', "id = $id");
		
		return new Category($result);
	}
	
	public function getLastCategory($owner)
	{
		$db = new DB();
		$result = $db->selectLast('category', "owner = $owner");
		
		return new Category($result);
	}
	
	public function getBookmarks($category, $owner)
	{
		$db = new DB();
		$result = $db->select('bookmark', "category = $category AND owner = $owner");
		
		return $result;
	}
	
	public function getRecentBookmarks($num, $owner)
	{
		$db = new DB();
		$result = $db->selectTOP("$num", 'bookmark', "owner = $owner");
		
		return $result;
	}

    public function getCatTitle($catID, $owner)
    {
        $db = new DB();
        $result = $db->select('category', "id = $catID AND owner = $owner", 'title');

        return $result;
    }

    public function getCategoryCount($catId, $owner)
    {
        $db = new DB();
        $result = $db->selectCount('bookmark', "owner = $owner AND category = $catId");

        return $result;
    }
	
	public function getBookmark($id)
	{
		$db = new DB();
		$result = $db->select('bookmark', "id = $id");
		
		return new Bookmark($result);
	}
	
	public function removeBookmark($id, $owner)
	{
		$db = new DB();
		$result = $db->delete('bookmark', "id = $id AND owner = $owner");
		
		return $result;
	}

    public function removeCategory($id, $owner)
    {
        $db = new DB();
        $db->delete('bookmark', "category = $id AND owner = $owner");

        $result2 = $db->delete('category', "id = $id AND owner = $owner");

        return $result2;
    }
	
	
//	public function checkURL($site)
//	{
//	if (isDomainAvailible($site))
//       {
//		   //exists
//               return true;
//       }
//       else
//       {
//		   //doesnt exists
//               return false;
//       }
//   
//	}
	
	 //returns true, if domain is availible, false if not
      public function checkURL($url)
       {
		  
		  $checkedURL = $this->correctURL($url);
			  
			  //if (strstr($domain, "http://") == $domain || strstr($domain, "ftp://") == $domain) { 
//		  			$checkedURL = $domain;
//		  		}
//		 	 else {
//				  $domain = "http://" . $domain;
//				  $checkedURL = $domain;
//		 	 }
			  
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

               if ($response) return $checkedURL;

               return false;
			  }
			  
			  else{
				  return false;
			  }
       }
	   
	   
	   
	   ////////////////////////////////////////////////////////////////
	public function correctURL($address)
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

	
}

?>