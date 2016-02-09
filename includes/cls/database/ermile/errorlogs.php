<?php
namespace database\ermile;
class errorlogs 
{
	public $id            = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $user_id       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $errorlog_id   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'errorlog'        ,'type'=>'smallint@5'];
	public $date_modified = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function errorlog_id()
	{
		$this->form()->type('select')->name('errorlog_')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>