<?php
namespace database\ermile;
class funds 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $fund_title = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $fund_slug = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $location_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Location', 'foreign'=>'locations@id!location_title');
	public $fund_initialbalance = array('type' => 'decimal@14,4!0.0000', 'null'=>'NO', 'show'=>'YES', 'label'=>'Initialbalance');
	public $fund_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("fund_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->form("select")->name("location")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function fund_initialbalance() 
	{
		$this->form("text")->name("initialbalance")->max(9999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function date_modified() {}
}
?>