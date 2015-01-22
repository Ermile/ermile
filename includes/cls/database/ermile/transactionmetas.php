<?php
namespace database\ermile;
class transactionmetas 
{
	public $id                     = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                            );
	public $transaction_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Transaction',   'type' => 'int@10',                            'foreign'=>'transactions@id!id');
	public $transactionmeta_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $transactionmeta_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@100',                       );
	public $transactionmeta_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Value',         'type' => 'varchar@200',                       );
	public $transactionmeta_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified          = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction_")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function transactionmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function transactionmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function transactionmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function transactionmeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>