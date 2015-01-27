<?php
namespace database\ermile;
class files 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                      );
	public $file_server   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Server',        'type' => 'smallint@5',                  );
	public $file_folder   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Folder',        'type' => 'smallint@5',                  );
	public $file_name     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'int@10',                      );
	public $file_code     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Code',          'type' => 'varchar@64',                  );
	public $file_size     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Size',          'type' => 'float@12,0',                  );
	public $file_status   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@init,inprogress,ready,', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                  );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function file_server() 
	{
		$this->form("text")->name("server")->min(0)->max(9999)->required()->type('number');
	}
	public function file_folder() 
	{
		$this->form("text")->name("folder")->min(0)->max(9999)->required()->type('number');
	}
	public function file_name() 
	{
		$this->form("text")->name("name")->min(0)->max(999999999)->required()->type('number');
	}
	public function file_code() 
	{
		$this->form("text")->name("code")->maxlength(64)->type('text');
	}
	public function file_size() 
	{
		$this->form("text")->name("size")->max(99999999999)->required()->type('number');
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