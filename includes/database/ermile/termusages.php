<?php
namespace database\ermile;
class termusages 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $term_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Term', 'foreign'=>'terms@id!term_title');
	public $post_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Post', 'foreign'=>'posts@id!post_title');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("select")->name("term")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>