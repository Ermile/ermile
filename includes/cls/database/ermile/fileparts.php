<?php
namespace database\ermile;
class fileparts 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                                                  );
	public $file_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'File',          'type' => 'int@10',                                                  'foreign'=>'files@id!file_title');
	public $filepart_part   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Part',          'type' => 'smallint@5',                                              );
	public $filepart_code   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Code',          'type' => 'varchar@64',                                              );
	public $filepart_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@awaiting,start,inprogress,appended,failed,finished', );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                              );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function file_id() 
	{
		$this->form("select")->name("file_")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function filepart_part() 
	{
		$this->form("text")->name("part")->min(0)->max(9999)->required()->type('number');
	}
	public function filepart_code() 
	{
		$this->form("text")->name("code")->maxlength(64)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function filepart_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>