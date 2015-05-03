<?php
namespace database\ermile;
class files 
{
	public $id            = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $file_server   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'server'          ,'type'=>'smallint@5'];
	public $file_folder   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'folder'          ,'type'=>'smallint@5'];
	public $file_code     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'code'            ,'type'=>'varchar@64'];
	public $file_size     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'size'            ,'type'=>'float@12,0'];
	public $file_status   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@inprogress,ready,temp'];
	public $date_modified = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function file_server()
	{
		$this->form()->type('number')->name('server')->min()->max('99999')->required();
	}

	public function file_folder()
	{
		$this->form()->type('number')->name('folder')->min()->max('99999')->required();
	}

	public function file_code()
	{
		$this->form()->type('text')->name('code')->maxlength('64');
	}

	public function file_size()
	{
		$this->form()->type('number')->name('size')->max('999999999999')->required();
	}

	public function file_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>