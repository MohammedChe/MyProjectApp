<?php
require_once 'UserTools.class.php';
require_once 'DB.class.php';


class Category {

	public $id;
	public $owner;
	public $title;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "";
		$this->owner = (isset($data['owner'])) ? $data['owner'] : "";
		$this->title = (isset($data['title'])) ? $data['title'] : "";
	}

	public function save($isNewCat = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewCat) {
			//set the data array
			$data = array(
				"title" => "'$this->title'"
			);
			
			//update the row in the database
			$db->update($data, 'category', 'id = '.$this->id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"owner" => "'$this->owner'",
				"title" => "'$this->title'"
			);
			
			$this->id = $db->insert($data, 'category');
		}
		return true;
	}
	
}

?>