<?php
namespace database\ermile;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $verification_type = array('type' => 'enum@emailregister,emailchange,emailforget,mobileregister,mobilechange,mobileforget', 'null'=>'NO', 'show'=>'YES', 'label'=>'Type');
	public $verification_value = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Value');
	public $verification_code = array('type' => 'varchar@32', 'null'=>'NO', 'show'=>'YES', 'label'=>'Code');
	public $verification_url = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Url');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Verified');
	public $verification_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $verification_createdate = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Createdate');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function verification_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function verification_value() 
	{
		$this->form("text")->name("value")->maxlength(50)->required()->type('text');
	}
	public function verification_code() 
	{
		$this->form("text")->name("code")->maxlength(32)->required()->type('text');
	}
	public function verification_url() 
	{
		$this->form("text")->name("url")->maxlength(100)->type('text');
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ radio button
	public function verification_verified() 
	{
		$this->form("radio")->name("verified")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function verification_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function verification_createdate() 
	{
		$this->form("text")->name("createdate");
	}
	public function date_modified() {}
}
?>