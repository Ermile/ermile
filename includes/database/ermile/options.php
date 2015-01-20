<?php
namespace database\ermile;
class options 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                        );
	public $option_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $option_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@50',                        );
	public $option_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Value',         'type' => 'varchar@200',                       );
	public $option_extra  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Extra',         'type' => 'varchar@400',                       );
	public $option_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function option_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function option_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}
	public function option_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}
	public function option_extra() 
	{
		$this->form("text")->name("extra")->maxlength(400)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function option_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>