<?php
namespace database\ermile;
class errorlogs 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',     );
	public $user_id       = array('null' =>'YES', 'show' =>'NO',  'label'=>'user',          'type' => 'smallint@5', 'foreign'=>'users@id!user_nickname');
	public $errorlog_id   = array('null' =>'NO',  'show' =>'YES', 'label'=>'errorlog',      'type' => 'smallint@5', 'foreign'=>'errorlogs@id!errorlog_title');
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@', );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function errorlog_id() 
	{
		$this->form("select")->name("errorlog_")->min(0)->max(99999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>