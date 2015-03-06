<?php
namespace database\ermile;
class users 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                                                                );
	public $user_type       = array('null' =>'YES', 'show' =>'YES', 'label'=>'type',          'type' => 'enum@storeadmin,storeemployee,storesupplier,storecustomer,admin,user!user', );
	public $user_mobile     = array('null' =>'NO',  'show' =>'YES', 'label'=>'mobile',        'type' => 'varchar@15',                                                                );
	public $user_pass       = array('null' =>'NO',  'show' =>'NO',  'label'=>'pass',          'type' => 'varchar@64',                                                                );
	public $user_email      = array('null' =>'YES', 'show' =>'YES', 'label'=>'email',         'type' => 'varchar@50',                                                                );
	public $user_gender     = array('null' =>'YES', 'show' =>'YES', 'label'=>'gender',        'type' => 'enum@male,female',                                                          );
	public $user_nickname   = array('null' =>'YES', 'show' =>'YES', 'label'=>'nickname',      'type' => 'varchar@50',                                                                );
	public $user_firstname  = array('null' =>'YES', 'show' =>'YES', 'label'=>'firstname',     'type' => 'varchar@50',                                                                );
	public $user_lastname   = array('null' =>'YES', 'show' =>'YES', 'label'=>'lastname',      'type' => 'varchar@50',                                                                );
	public $user_birthday   = array('null' =>'YES', 'show' =>'YES', 'label'=>'birthday',      'type' => 'datetime@',                                                                 );
	public $user_status     = array('null' =>'YES', 'show' =>'YES', 'label'=>'status',        'type' => 'enum@active,awaiting,deactive,removed,filter!awaiting',                     );
	public $user_credit     = array('null' =>'YES', 'show' =>'YES', 'label'=>'credit',        'type' => 'enum@yes,no!no',                                                            );
	public $permission_id   = array('null' =>'YES', 'show' =>'YES', 'label'=>'permission',    'type' => 'smallint@5',                                                                'foreign'=>'permissions@id!permission_title');
	public $user_createdate = array('null' =>'NO',  'show' =>'YES', 'label'=>'createdate',    'type' => 'datetime@',                                                                 );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                                                );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function user_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ mobile
	public function user_mobile() 
	{
		$this->form("#mobile")->maxlength(15)->required()->type('text');
	}

	//------------------------------------------------------------------ pass
	public function user_pass() 
	{
		$this->form("#pass")->maxlength(64)->required()->type('password');
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->maxlength(50)->type('email');
	}

	//------------------------------------------------------------------ radio button
	public function user_gender() 
	{
		$this->form("radio")->name("gender")->type("radio");
		$this->setChild();
	}
	public function user_nickname() 
	{
		$this->form("text")->name("nickname")->maxlength(50)->type('text');
	}
	public function user_firstname() 
	{
		$this->form("text")->name("firstname")->maxlength(50)->type('text');
	}
	public function user_lastname() 
	{
		$this->form("text")->name("lastname")->maxlength(50)->type('text');
	}
	public function user_birthday() 
	{
		$this->form("text")->name("birthday");
	}

	//------------------------------------------------------------------ select button
	public function user_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function user_credit() 
	{
		$this->form("radio")->name("credit")->type("radio");
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
		$this->form("text")->name("createdate")->required();
	}
	public function date_modified() {}
}
?>