<?php
namespace database\ermile;
class userlogs 
{
	public $id               = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $userlog_title    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@50'];
	public $userlog_desc     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@999'];
	public $userlog_priority = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'priority'        ,'type'=>'enum@high,medium,low!medium'];
	public $userlog_type     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@forgetpassword'];
	public $user_id          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $date_modified    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function userlog_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('50');
	}

	public function userlog_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('999');
	}

	public function userlog_priority()
	{
		$this->form()->type('radio')->name('priority')->required();
		$this->setChild();
	}

	public function userlog_type()
	{
		$this->form()->type('radio')->name('type');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_');
		$this->setChild();
	}

	public function date_modified(){}
}
?>