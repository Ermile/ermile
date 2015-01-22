<?php
namespace database\jibres;
class users 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $user_type = array('type' => 'enum@store_admin,store_employee,store_supplier,store_customer,admin,user!user', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $user_pass = array('type' => 'char@32', 'null'=>'NO', 'show'=>'NO', 'label'=>'Password');
	public $user_email = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Email');
	public $user_gender = array('type' => 'enum@male,female', 'null'=>'YES', 'show'=>'YES', 'label'=>'Gender');
	public $user_married = array('type' => 'enum@single,married', 'null'=>'YES', 'show'=>'YES', 'label'=>'Married');
	public $user_firstname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Firstname');
	public $user_lastname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Lastname');
	public $user_nickname = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Nickname');
	public $user_tel = array('type' => 'varchar@15', 'null'=>'YES', 'show'=>'NO', 'label'=>'Tel');
	public $user_mobile = array('type' => 'varchar@15', 'null'=>'NO', 'show'=>'YES', 'label'=>'Mobile');
	public $user_birthday = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Birthday');
	public $user_country = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Country');
	public $user_state = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'State');
	public $user_city = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'City');
	public $user_address = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'YES', 'label'=>'Address');
	public $user_postcode = array('type' => 'varchar@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Postcode');
	public $user_newsletter = array('type' => 'enum@yes,no!no', 'null'=>'YES', 'show'=>'YES', 'label'=>'Newsletter');
	public $user_refer = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Refer');
	public $user_nationalcode = array('type' => 'varchar@15', 'null'=>'YES', 'show'=>'YES', 'label'=>'Nationalcode');
	public $user_website = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'NO', 'label'=>'Website');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed!awaiting', 'null'=>'YES', 'show'=>'YES', 'label'=>'Status');
	public $user_degree = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Degree');
	public $user_activity = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Activity');
	public $user_incomes = array('type' => 'bigint@11', 'null'=>'YES', 'show'=>'NO', 'label'=>'User Incomes');
	public $user_outcomes = array('type' => 'bigint@11', 'null'=>'YES', 'show'=>'NO', 'label'=>'User Outcomes');
	public $user_credit = array('type' => 'enum@yes,no!no', 'null'=>'YES', 'show'=>'YES', 'label'=>'Credit');
	public $user_question = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Question');
	public $user_answer = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Answer');
	public $user_extra = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'NO', 'label'=>'Extra');
	public $user_logincount = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'User Logincount');
	public $permission_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Permission', 'foreign'=>'permissions@id!permission_title');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function user_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild();
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
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function user_married() 
	{
		$this->form("radio")->name("married")->type("radio");
		$this->setChild();
	}
	public function user_firstname() 
	{
		$this->form("text")->name("firstname")->maxlength(50)->type('text');
	}
	public function user_lastname() 
	{
		$this->form("text")->name("lastname")->maxlength(50)->type('text');
	}
	public function user_nickname() 
	{
		$this->form("text")->name("nickname")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ website
	public function user_tel() 
	{
		$this->form()->type("tel")->name("tel")->pattern(".{9,}")->maxlength(17);
	}

	//------------------------------------------------------------------ website
	public function user_mobile() 
	{
		$this->form()->type("tel")->name("mobile")->pl("Mobile")->pattern(".{10,}")->maxlength(17)->required();
	}
	public function user_birthday() 
	{
		$this->form("text")->name("birthday");
	}
	public function user_country() 
	{
		$this->form("text")->name("country")->min(0)->max(9999)->type('number');
	}
	public function user_state() 
	{
		$this->form("text")->name("state")->min(0)->max(9999)->type('number');
	}
	public function user_city() 
	{
		$this->form("text")->name("city")->min(0)->max(9999)->type('number');
	}
	public function user_address() 
	{
		$this->form("text")->name("address")->maxlength(200)->type('textarea');
	}
	public function user_postcode() 
	{
		$this->form("text")->name("postcode")->maxlength(10)->type('text');
	}

	//------------------------------------------------------------------ radio button
	public function user_newsletter() 
	{
		$this->form("radio")->name("newsletter")->type("radio");
		$this->setChild();
	}
	public function user_refer() 
	{
		$this->form("text")->name("refer")->maxlength(50)->type('text');
	}
	public function user_nationalcode() 
	{
		$this->form("text")->name("nationalcode")->maxlength(15)->type('text');
	}

	//------------------------------------------------------------------ website
	public function user_website() 
	{
		$this->form("#website")->type("url")->maxlength(100);
	}

	//------------------------------------------------------------------ select button
	public function user_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild();
	}
	public function user_degree() 
	{
		$this->form("text")->name("degree")->maxlength(50)->type('text');
	}
	public function user_activity() 
	{
		$this->form("text")->name("activity")->maxlength(50)->type('text');
	}
	public function user_incomes() {}
	public function user_outcomes() {}

	//------------------------------------------------------------------ radio button
	public function user_credit() 
	{
		$this->form("radio")->name("credit")->type("radio");
		$this->setChild();
	}
	public function user_question() 
	{
		$this->form("text")->name("question")->maxlength(100)->type('text');
	}
	public function user_answer() 
	{
		$this->form("text")->name("answer")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ Extra
	public function user_extra() 
	{
		$this->form()->type("text")->label("Extra")->pl("Extra value")->name("extra")->required()
			->maxlength(20)->pattern("^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$")->title("start with letter. 3 to 20 characters or number");
	}
	public function user_logincount() {}

	//------------------------------------------------------------------ id - foreign key
	public function permission_id() 
	{
		$this->form("select")->name("permission")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>