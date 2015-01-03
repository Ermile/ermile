<?php
namespace database\ermile;
class costs 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $cost_title = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $cost_price = array('type' => 'decimal@13,4', 'null'=>'NO', 'show'=>'YES', 'label'=>'Price');
	public $costcat_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Costcat', 'foreign'=>'costcats@id!costcat_title');
	public $account_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Account', 'foreign'=>'accounts@id!account_title');
	public $cost_date = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Date');
	public $cost_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'null'=>'NO', 'show'=>'YES', 'label'=>'Type');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}
	public function cost_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function costcat_id() 
	{
		$this->form("select")->name("costcat")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("select")->name("account")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function cost_date() 
	{
		$this->form("text")->name("date")->required();
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function cost_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>