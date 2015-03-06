<?php
namespace database\ermile;
class funds 
{
	public $id                  = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',          );
	public $fund_title          = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@100',         );
	public $fund_slug           = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@100',         );
	public $location_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'location',      'type' => 'smallint@5',          'foreign'=>'locations@id!location_title');
	public $fund_initialbalance = array('null' =>'NO',  'show' =>'YES', 'label'=>'initialbalance','type' => 'decimal@14,4!0.0000', );
	public $fund_desc           = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',         );
	public $date_modified       = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',          );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("#slug")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->form("select")->name("location_")->min(0)->max(99999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function fund_initialbalance() 
	{
		$this->form("text")->name("initialbalance")->max(99999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ desc
	public function fund_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function date_modified() {}
}
?>