<?php
namespace database\jibres;
class transactions 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $transaction_type = array('type' => 'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale', 'null'=>'NO', 'show'=>'YES', 'label'=>'Type');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $user_id_customer = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $transaction_date = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'null'=>'NO', 'show'=>'YES', 'label'=>'Sum');
	public $transaction_discount = array('type' => 'decimal@13,4!0.0000', 'null'=>'NO', 'show'=>'YES', 'label'=>'Discount');
	public $transaction_initialreceived = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Initialreceived');
	public $transaction_received = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Remained');
	public $transaction_pre = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Pre');
	public $transaction_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $transaction_transport = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Transport');
	public $transaction_vat = array('type' => 'enum@yes,nocalc,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Vat');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function transaction_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_id_customer() 
	{
		$this->form("select")->name("user")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function transaction_date() 
	{
		$this->form("text")->name("date")->required();
	}
	public function transaction_sum() 
	{
		$this->form("text")->name("sum")->max(999999999999)->required()->type('number');
	}
	public function transaction_discount() 
	{
		$this->form("text")->name("discount")->max(999999999999)->required()->type('number');
	}
	public function transaction_initialreceived() 
	{
		$this->form("text")->name("initialreceived")->max(999999999999)->type('number');
	}
	public function transaction_received() 
	{
		$this->form("text")->name("received")->max(999999999999)->type('number');
	}
	public function transaction_remained() 
	{
		$this->form("text")->name("remained")->max(999999999999)->type('number');
	}
	public function transaction_pre() 
	{
		$this->form("text")->name("pre")->required()->type('select');
	}

	//------------------------------------------------------------------ description
	public function transaction_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function transaction_transport() 
	{
		$this->form("text")->name("transport")->max(999999999999)->type('number');
	}
	public function transaction_vat() 
	{
		$this->form("text")->name("vat")->required()->type('select');
	}
	public function date_modified() {}
}
?>