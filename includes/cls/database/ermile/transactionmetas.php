<?php
namespace database\ermile;
class transactionmetas 
{
	public $id                     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@10'];
	public $transaction_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'transaction'     ,'type'=>'bigint@20'                       ,'foreign'=>'transactions@id!id'];
	public $transactionmeta_cat    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $transactionmeta_key    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'key'             ,'type'=>'varchar@100'];
	public $transactionmeta_value  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@200'];
	public $transactionmeta_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function transaction_id()
	{
		$this->form()->type('select')->name('transaction_')->required();
		$this->setChild();
	}

	public function transactionmeta_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50')->required();
	}

	public function transactionmeta_key()
	{
		$this->form()->type('text')->name('key')->maxlength('100')->required();
	}

	public function transactionmeta_value()
	{
		$this->form()->type('textarea')->name('value')->maxlength('200');
	}

	public function transactionmeta_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>