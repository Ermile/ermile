<?php
namespace database\ermile;
class userlogs 
{
	public $id               = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                      );
	public $userlog_title    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                  );
	public $userlog_desc     = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@999',                 );
	public $userlog_priority = array('null' =>'NO',  'show' =>'YES', 'label'=>'Priority',      'type' => 'enum@high,medium,low!medium', );
	public $userlog_type     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Type',          'type' => 'enum@forgetpassword',         );
	public $user_id          = array('null' =>'YES', 'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                  'foreign'=>'users@id!user_nickname');
	public $date_modified    = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                  );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function userlog_title() 
	{
		$this->form("#title")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ desc
	public function userlog_desc() 
	{
		$this->form("#desc")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function userlog_priority() 
	{
		$this->form("select")->name("priority")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function userlog_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild();
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>