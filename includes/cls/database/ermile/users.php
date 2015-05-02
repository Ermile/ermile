<?php
namespace database\ermile;
class users 
{
	public $id               = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                                                );
	public $user_mobile      = array('null' =>'NO',  'show' =>'YES', 'label'=>'mobile',        'type' => 'varchar@15',                                            );
	public $user_email       = array('null' =>'YES', 'show' =>'YES', 'label'=>'email',         'type' => 'varchar@50',                                            );
	public $user_pass        = array('null' =>'NO',  'show' =>'NO',  'label'=>'pass',          'type' => 'varchar@64',                                            );
	public $user_displayname = array('null' =>'YES', 'show' =>'YES', 'label'=>'displayname',   'type' => 'varchar@50',                                            );
	public $user_status      = array('null' =>'YES', 'show' =>'YES', 'label'=>'status',        'type' => 'enum@active,awaiting,deactive,removed,filter!awaiting', );
	public $permission_id    = array('null' =>'YES', 'show' =>'YES', 'label'=>'permission',    'type' => 'smallint@5',                                            'foreign'=>'permissions@id!permission_title');
	public $user_createdate  = array('null' =>'NO',  'show' =>'YES', 'label'=>'createdate',    'type' => 'datetime@',                                             );
	public $date_modified    = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                            );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ mobile
	public function user_mobile() 
	{
		$this->form("#mobile")->maxlength(15)->required()->type('text');
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->maxlength(50)->type('email');
	}

	//------------------------------------------------------------------ pass
	public function user_pass() 
	{
		$this->form("#pass")->maxlength(64)->required()->type('password');
	}
	public function user_displayname() 
	{
		$this->form("text")->name("displayname")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function user_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function permission_id() 
	{
		$this->form("select")->name("permission_")->min(0)->max(99999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function user_createdate() 
	{
		$this->form("text")->name("createdate")->required()->type('text');
	}
	public function date_modified() {}
}
?>