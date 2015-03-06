<?php
namespace database\ermile;
class costs 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                  );
	public $cost_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@50',                  );
	public $cost_price    = array('null' =>'NO',  'show' =>'YES', 'label'=>'price',         'type' => 'decimal@13,4',                );
	public $costcat_id    = array('null' =>'NO',  'show' =>'YES', 'label'=>'costcat',       'type' => 'smallint@5',                  'foreign'=>'costcats@id!costcat_title');
	public $account_id    = array('null' =>'NO',  'show' =>'YES', 'label'=>'account',       'type' => 'smallint@5',                  'foreign'=>'accounts@id!account_title');
	public $cost_date     = array('null' =>'NO',  'show' =>'YES', 'label'=>'date',          'type' => 'datetime@',                   );
	public $cost_desc     = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                 );
	public $cost_type     = array('null' =>'NO',  'show' =>'YES', 'label'=>'type',          'type' => 'enum@income,outcome!outcome', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                  );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}
	public function cost_price() 
	{
		$this->form("text")->name("price")->max(9999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function costcat_id() 
	{
		$this->form("select")->name("costcat_")->min(0)->max(99999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("select")->name("account_")->min(0)->max(99999)->required()->type("select")->validate()->id();
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