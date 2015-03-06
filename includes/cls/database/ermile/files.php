<?php
namespace database\ermile;
class files 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                     );
	public $file_server   = array('null' =>'NO',  'show' =>'YES', 'label'=>'server',        'type' => 'smallint@5',                 );
	public $file_folder   = array('null' =>'NO',  'show' =>'YES', 'label'=>'folder',        'type' => 'smallint@5',                 );
	public $file_code     = array('null' =>'YES', 'show' =>'YES', 'label'=>'code',          'type' => 'varchar@64',                 );
	public $file_size     = array('null' =>'NO',  'show' =>'YES', 'label'=>'size',          'type' => 'float@12,0',                 );
	public $file_status   = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@inprogress,ready,temp', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                 );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}
	public function file_server() 
	{
		$this->form("text")->name("server")->min(0)->max(99999)->required()->type('number');
	}
	public function file_folder() 
	{
		$this->form("text")->name("folder")->min(0)->max(99999)->required()->type('number');
	}
	public function file_code() 
	{
		$this->form("text")->name("code")->maxlength(64)->type('text');
	}
	public function file_size() 
	{
		$this->form("text")->name("size")->max(999999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ select button
	public function file_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>