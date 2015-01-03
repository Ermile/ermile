<?php
namespace database\ermile;
class smss 
{
	public $id                     = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $account_title          = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $account_slug           = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $bank_id                = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Bank', 'foreign'=>'banks@id!bank_title');
	public $account_branch         = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Branch');
	public $account_number         = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Number');
	public $account_card           = array('type' => 'varchar@30', 'null'=>'YES', 'show'=>'YES', 'label'=>'Card');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'null'=>'NO', 'show'=>'YES', 'label'=>'Primarybalance');
	public $account_desc           = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $user_id                = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $date_modified          = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function account_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function account_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("account_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("select")->name("bank")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function account_branch() 
	{
		$this->form("text")->name("branch")->maxlength(50)->type('text');
	}
	public function account_number() 
	{
		$this->form("text")->name("number")->maxlength(50)->type('text');
	}
	public function account_card() 
	{
		$this->form("text")->name("card")->maxlength(30)->type('text');
	}
	public function account_primarybalance() 
	{
		$this->form("text")->name("primarybalance")->max(9999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ description
	public function account_desc() 
	{
		$this->form("desc")->maxlength(200)->type('textarea');
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>