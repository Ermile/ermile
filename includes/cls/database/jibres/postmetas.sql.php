<?php
namespace database\jibres;
class postmetas 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $post_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Post', 'foreign'=>'posts@id!post_title');
	public $postmeta_name = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $postmeta_value = array('type' => 'varchar@999', 'null'=>'YES', 'show'=>'YES', 'label'=>'Value');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function postmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function postmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(999)->type('textarea');
	}
	public function date_modified() {}
}
?>