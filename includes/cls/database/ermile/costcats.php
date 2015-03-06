<?php
namespace database\ermile;
class costcats 
{
	public $id             = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                        );
	public $costcat_title  = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@50',                        );
	public $costcat_slug   = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@50',                        );
	public $costcat_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                       );
	public $costcat_parent = array('null' =>'YES', 'show' =>'YES', 'label'=>'parent',        'type' => 'smallint@5',                        );
	public $costcat_order  = array('null' =>'YES', 'show' =>'YES', 'label'=>'order',         'type' => 'smallint@5',                        );
	public $costcat_type   = array('null' =>'YES', 'show' =>'YES', 'label'=>'type',          'type' => 'enum@income,outcome',               );
	public $costcat_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified  = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
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
		$this->form("text")->name("parent")->max(99999)->type('number');
	}
	public function costcat_order() 
	{
		$this->form("text")->name("order")->max(99999)->type('number');
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