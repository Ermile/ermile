<?php
namespace database\ermile;
class options 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $option_cat = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Cat');
	public $option_name = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $option_value = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'YES', 'label'=>'Value');
	public $option_extra = array('type' => 'varchar@400', 'null'=>'YES', 'show'=>'YES', 'label'=>'Extra');
	public $option_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


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
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>