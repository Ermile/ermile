<?php
namespace database\ermile;
class errors 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $error_title = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $error_solution = array('type' => 'varchar@999', 'null'=>'YES', 'show'=>'YES', 'label'=>'Solution');
	public $error_priority = array('type' => 'enum@critical,high,medium,low!medium', 'null'=>'NO', 'show'=>'YES', 'label'=>'Priority');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function error_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->required()->type('text');
	}
	public function error_solution() 
	{
		$this->form("text")->name("solution")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function error_priority() 
	{
		$this->form("select")->name("priority")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>