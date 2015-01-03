<?php
namespace database\ermile;
class receipts 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $receipt_code = array('type' => 'varchar@30', 'null'=>'YES', 'show'=>'YES', 'label'=>'Code');
	public $receipt_type = array('type' => 'enum@income,outcome!income', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'null'=>'NO', 'show'=>'YES', 'label'=>'Price');
	public $receipt_date = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Date');
	public $paper_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Paper', 'foreign'=>'papers@id!id');
	public $receipt_paperdate = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Paperdate');
	public $receipt_paperstatus = array('type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', 'null'=>'YES', 'show'=>'YES', 'label'=>'Paperstatus');
	public $receipt_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $transaction_id = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Transaction', 'foreign'=>'transactions@id!id');
	public $fund_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Fund', 'foreign'=>'funds@id!fund_title');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $user_id_customer = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function receipt_code() 
	{
		$this->form("text")->name("code")->maxlength(30)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function receipt_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function receipt_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->required()->type('number');
	}
	public function receipt_date() 
	{
		$this->form("text")->name("date")->required();
	}

	//------------------------------------------------------------------ id - foreign key
	public function paper_id() 
	{
		$this->form("select")->name("paper")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function receipt_paperdate() 
	{
		$this->form("text")->name("paperdate");
	}

	//------------------------------------------------------------------ select button
	public function receipt_paperstatus() 
	{
		$this->form("select")->name("paperstatus")->type("select")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ description
	public function receipt_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->form("select")->name("fund")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_id_customer() 
	{
		$this->form("select")->name("user")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>