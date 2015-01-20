<?php
namespace database\ermile;
class errorlogs 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',     );
	public $user_id       = array('null' =>'YES', 'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5', 'foreign'=>'users@id!user_nickname');
	public $errorlog_id   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Errorlog',      'type' => 'smallint@5', 'foreign'=>'errorlogs@id!errorlog_title');
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@', );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function errorlog_id() 
	{
		$this->form("select")->name("errorlog_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>