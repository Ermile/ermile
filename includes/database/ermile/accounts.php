<?php
namespace database\ermile;
class accounts 
{
	public $id                     = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',          );
	public $account_title          = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',          );
	public $account_slug           = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@50',          );
	public $bank_id                = array('null' =>'NO',  'show' =>'YES', 'label'=>'Bank',          'type' => 'smallint@5',          'foreign'=>'banks@id!bank_title');
	public $account_branch         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Branch',        'type' => 'varchar@50',          );
	public $account_number         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Number',        'type' => 'varchar@50',          );
	public $account_card           = array('null' =>'YES', 'show' =>'YES', 'label'=>'Card',          'type' => 'varchar@30',          );
	public $account_primarybalance = array('null' =>'NO',  'show' =>'YES', 'label'=>'Primarybalance','type' => 'decimal@14,4!0.0000', );
	public $account_desc           = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',         );
	public $user_id                = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',          'foreign'=>'users@id!user_nickname');
	public $date_modified          = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',          );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function account_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function account_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("select")->name("bank_")->min(0)->max(9999)->required()->type("select")->validate()->id();
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

	//------------------------------------------------------------------ desc
	public function account_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>