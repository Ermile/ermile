<?php
namespace database\ermile;
class errorlogs 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $user_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $errorlog_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Errorlog', 'foreign'=>'errorlogs@id!errorlog_title');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function errorlog_id() 
	{
		$this->form("select")->name("errorlog")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>