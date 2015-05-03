<?php
namespace database\ermile;
class fileparts 
{
	public $id              = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $file_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'file'            ,'type'=>'int@10'                          ,'foreign'=>'files@id!id'];
	public $filepart_part   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'part'            ,'type'=>'smallint@5'];
	public $filepart_code   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'code'            ,'type'=>'varchar@64'];
	public $filepart_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@awaiting,start,inprogress,appended,failed,finished'];
	public $date_modified   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function file_id()
	{
		$this->form()->type('select')->name('file_')->required();
		$this->setChild();
	}

	public function filepart_part()
	{
		$this->form()->type('number')->name('part')->min()->max('99999')->required();
	}

	public function filepart_code()
	{
		$this->form()->type('text')->name('code')->maxlength('64');
	}

	public function filepart_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>