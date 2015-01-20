<?php
namespace database\ermile;
class costs 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                  );
	public $cost_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                  );
	public $cost_price    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Price',         'type' => 'decimal@13,4',                );
	public $costcat_id    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Costcat',       'type' => 'smallint@5',                  'foreign'=>'costcats@id!costcat_title');
	public $account_id    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Account',       'type' => 'smallint@5',                  'foreign'=>'accounts@id!account_title');
	public $cost_date     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Date',          'type' => 'datetime@',                   );
	public $cost_desc     = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',                 );
	public $cost_type     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Type',          'type' => 'enum@income,outcome!outcome', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                  );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}
	public function cost_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function costcat_id() 
	{
		$this->form("select")->name("costcat_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("select")->name("account_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function cost_date() 
	{
		$this->form("text")->name("date")->required();
	}

	//------------------------------------------------------------------ desc
	public function cost_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function cost_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>