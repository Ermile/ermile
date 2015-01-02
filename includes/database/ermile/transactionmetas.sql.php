<?php
namespace sql;
class transactionmetas 
{
	public $id = array('type' => 'smallint@6', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $transaction_id = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Transaction', 'foreign'=>'transactions@id!id');
	public $transactionmeta_cat = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Cat');
	public $transactionmeta_name = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Name');
	public $transactionmeta_value = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'YES', 'label'=>'Value');
	public $transactionmeta_status = array('type' => 'enum@enable,disable!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function transactionmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->type('text');
	}
	public function transactionmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->type('text');
	}
	public function transactionmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function transactionmeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>