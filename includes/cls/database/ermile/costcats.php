<?php
namespace database\ermile;
class costcats 
{
	public $id             = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                        );
	public $costcat_title  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                        );
	public $costcat_slug   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@50',                        );
	public $costcat_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',                       );
	public $costcat_parent = array('null' =>'YES', 'show' =>'YES', 'label'=>'Parent',        'type' => 'smallint@5',                        );
	public $costcat_order  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Order',         'type' => 'smallint@5',                        );
	public $costcat_type   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Type',          'type' => 'enum@income,outcome',               );
	public $costcat_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified  = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function costcat_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function costcat_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ desc
	public function costcat_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function costcat_parent() 
	{
		$this->form("text")->name("parent")->max(9999)->type('number');
	}
	public function costcat_order() 
	{
		$this->form("text")->name("order")->max(9999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function costcat_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function costcat_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>