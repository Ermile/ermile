<?php
namespace database\ermile;
class userlogs 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $userlog_title = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Title');
	public $userlog_desc = array('type' => 'varchar@999', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $userlog_priority = array('type' => 'enum@high,medium,low!medium', 'null'=>'NO', 'show'=>'YES', 'label'=>'Priority');
	public $userlog_type = array('type' => 'enum@forgetpassword', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $user_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function userlog_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ description
	public function userlog_desc() 
	{
		$this->form("#desc")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function userlog_priority() 
	{
		$this->form("select")->name("priority")->type("select")->required()->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function userlog_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>