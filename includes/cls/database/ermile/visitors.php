<?php
namespace database\ermile;
class visitors 
{
	public $id                 = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $visitor_ip         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'ip'              ,'type'=>'int@10'];
	public $visitor_url        = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'url'             ,'type'=>'varchar@255'];
	public $visitor_agent      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'agent'           ,'type'=>'varchar@255'];
	public $visitor_referer    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'referer'         ,'type'=>'varchar@255'];
	public $visitor_robot      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'robot'           ,'type'=>'enum@yes,no!no'];
	public $user_id            = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $visitor_createdate = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'createdate'      ,'type'=>'datetime@'];
	public $date_modified      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function visitor_ip()
	{
		$this->form()->type('number')->name('ip')->min()->max('9999999999')->required();
	}

	public function visitor_url()
	{
		$this->form()->type('textarea')->name('url')->maxlength('255')->required();
	}

	public function visitor_agent()
	{
		$this->form()->type('textarea')->name('agent')->maxlength('255')->required();
	}

	public function visitor_referer()
	{
		$this->form()->type('textarea')->name('referer')->maxlength('255');
	}

	public function visitor_robot()
	{
		$this->form()->type('radio')->name('robot')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_');
		$this->setChild();
	}

	public function visitor_createdate()
	{
		$this->form()->type('text')->name('createdate');
	}

	public function date_modified(){}
}
?>