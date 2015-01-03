<?php
namespace database\ermile;
class users 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $user_type = array('type' => 'enum@storeadmin,storeemployee,storesupplier,storecustomer,admin,user!user', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $user_mobile = array('type' => 'varchar@15', 'null'=>'NO', 'show'=>'YES', 'label'=>'Mobile');
	public $user_pass = array('type' => 'char@32', 'null'=>'NO', 'show'=>'NO', 'label'=>'Password');
	public $user_email = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Email');
	public $user_gender = array('type' => 'enum@male,female', 'null'=>'YES', 'show'=>'YES', 'label'=>'Gender');
	public $user_nickname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Nickname');
	public $user_firstname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Firstname');
	public $user_lastname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Lastname');
	public $user_birthday = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Birthday');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed,filter!awaiting', 'null'=>'YES', 'show'=>'YES', 'label'=>'Status');
	public $user_credit = array('type' => 'enum@yes,no!no', 'null'=>'YES', 'show'=>'YES', 'label'=>'Credit');
	public $permission_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Permission', 'foreign'=>'permissions@id!permission_title');
	public $user_createdate = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Createdate');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function user_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ website
	public function user_mobile() 
	{
		$this->form()->type("tel")->name("mobile")->pl("Mobile")->pattern(".{10,}")->maxlength(17)->required();
	}

	//------------------------------------------------------------------ password
	public function user_pass() 
	{
		$this->form()->name("pass")->pl("Password")->type("password")->required()->maxlength(20)
			->pattern("^.{5,20}$")->title("between 5-20 character")->validate()->password();
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->type("email")->required()->maxlength(50);
	}

	//------------------------------------------------------------------ radio button
	public function user_gender() 
	{
		$this->form("radio")->name("gender")->type("radio");
		$this->setChild($this->form);
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
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function user_credit() 
	{
		$this->form("radio")->name("credit")->type("radio");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function permission_id() 
	{
		$this->form("select")->name("permission")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function user_createdate() 
	{
		$this->form("text")->name("createdate")->required();
	}
	public function date_modified() {}
}
?>