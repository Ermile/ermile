<?php
namespace database\ermile;
class transactions 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $transaction_type = array('type' => 'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale', 'null'=>'NO', 'show'=>'YES', 'label'=>'Type');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $user_id_customer = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $transaction_date = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'null'=>'NO', 'show'=>'YES', 'label'=>'Sum');
	public $transaction_remained = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Remained');
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
	public function transaction_remained() 
	{
		$this->form("text")->name("remained")->max(999999999999)->type('number');
	}
	public function date_modified() {}
}
?>