<?php
namespace database\ermile;
class errors 
{
	public $id             = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                           );
	public $error_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',                          );
	public $error_solution = array('null' =>'YES', 'show' =>'YES', 'label'=>'Solution',      'type' => 'varchar@999',                          );
	public $error_priority = array('null' =>'NO',  'show' =>'YES', 'label'=>'Priority',      'type' => 'enum@critical,high,medium,low!medium', );
	public $date_modified  = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                           );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function error_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}
	public function error_solution() 
	{
		$this->form("text")->name("solution")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function error_priority() 
	{
		$this->form("select")->name("priority")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>