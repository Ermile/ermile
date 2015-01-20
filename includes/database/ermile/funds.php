<?php
namespace database\ermile;
class funds 
{
	public $id                  = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'smallint@5',          );
	public $fund_title          = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',         );
	public $fund_slug           = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@100',         );
	public $location_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Location',      'type' => 'smallint@5',          'foreign'=>'locations@id!location_title');
	public $fund_initialbalance = array('null' =>'NO',  'show' =>'YES', 'label'=>'Initialbalance','type' => 'decimal@14,4!0.0000', );
	public $fund_desc           = array('null' =>'YES', 'show' =>'NO',  'label'=>'Description',   'type' => 'varchar@200',         );
	public $date_modified       = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',          );


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
		$this->setChild();
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