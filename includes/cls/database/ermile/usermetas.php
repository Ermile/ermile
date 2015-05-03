<?php
namespace database\ermile;
class usermetas 
{
	public $id              = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $user_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $usermeta_cat    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $usermeta_key    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'key'             ,'type'=>'varchar@100'];
	public $usermeta_value  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@500'];
	public $usermeta_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_')->required();
		$this->setChild();
	}

	public function usermeta_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50')->required();
	}

	public function usermeta_key()
	{
		$this->form()->type('text')->name('key')->maxlength('100')->required();
	}

	public function usermeta_value()
	{
		$this->form()->type('textarea')->name('value')->maxlength('500');
	}

	public function usermeta_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>