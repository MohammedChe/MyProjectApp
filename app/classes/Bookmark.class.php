<?php
require_once 'UserTools.class.php';
require_once 'DB.class.php';


class Bookmark {

	public $id;
	public $category;
	public $owner;
	public $url;
    public $note;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "";
		$this->category = (isset($data['category'])) ? $data['category'] : "";
		$this->owner = (isset($data['owner'])) ? $data['owner'] : "";
		$this->url = (isset($data['url'])) ? $data['url'] : "";
        $this->note = (isset($data['note'])) ? $data['note'] : "";
	}

	public function save($isNewMark = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewMark) {
			//set the data array
			$data = array(
				//"url" => "'$this->url'"
			);
			
			//update the row in the database
			//$db->update($data, 'bookmark', 'id = '.$this->id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"category" => "'$this->category'",
				"owner" => "'$this->owner'",
				"url" => "'$this->url'",
                "note" => "'$this->note'"
			);
			
			$this->id = $db->insert($data, 'bookmark');
		}
		return true;
	}
	
}

?>