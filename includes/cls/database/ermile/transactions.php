<?php
namespace database\ermile;
class transactions 
{
	public $id                   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $transaction_type     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale'];
	public $user_id              = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $user_idcustomer      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user customer'   ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_custome_displayname'];
	public $transaction_date     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'date'            ,'type'=>'datetime@'];
	public $transaction_sum      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'sum'             ,'type'=>'decimal@13,4'];
	public $transaction_remained = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'remained'        ,'type'=>'decimal@13,4'];
	public $date_modified        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function transaction_type()
	{
		$this->form()->type('radio')->name('type')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_idcustomer()
	{
		$this->form()->type('select')->name('user_customer')->required();
		$this->setChild();
	}

	public function transaction_date()
	{
		$this->form()->type('text')->name('date')->required();
	}

	public function transaction_sum()
	{
		$this->form()->type('number')->name('sum')->max('9999999999999')->required();
	}

	public function transaction_remained()
	{
		$this->form()->type('number')->name('remained')->max('9999999999999');
	}

	public function date_modified(){}
}
?>