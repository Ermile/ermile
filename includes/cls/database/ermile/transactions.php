<?php
namespace database\ermile;
class transactions 
{
	public $id                   = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'bigint@20',                                                                                         );
	public $transaction_type     = array('null' =>'NO',  'show' =>'YES', 'label'=>'type',          'type' => 'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale', );
	public $user_id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'int@10',                                                                                            'foreign'=>'users@id!user_nickname');
	public $user_idcustomer      = array('null' =>'NO',  'show' =>'NO',  'label'=>'user customer', 'type' => 'int@10',                                                                                            'foreign'=>'users@id!user_nickname');
	public $transaction_date     = array('null' =>'NO',  'show' =>'YES', 'label'=>'date',          'type' => 'datetime@',                                                                                         );
	public $transaction_sum      = array('null' =>'NO',  'show' =>'YES', 'label'=>'sum',           'type' => 'decimal@13,4',                                                                                      );
	public $transaction_remained = array('null' =>'YES', 'show' =>'YES', 'label'=>'remained',      'type' => 'decimal@13,4',                                                                                      );
	public $date_modified        = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                                                                        );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function transaction_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_idcustomer() 
	{
		$this->form("select")->name("user_customer")->min(0)->max(9999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function transaction_date() 
	{
		$this->form("text")->name("date")->required()->type('text');
	}
	public function transaction_sum() 
	{
		$this->form("text")->name("sum")->max(9999999999999)->required()->type('number');
	}
	public function transaction_remained() 
	{
		$this->form("text")->name("remained")->max(9999999999999)->type('number');
	}
	public function date_modified() {}
}
?>