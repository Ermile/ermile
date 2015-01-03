<?php
namespace database\ermile;
class papers 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $paper_type = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $paper_number = array('type' => 'varchar@20', 'null'=>'YES', 'show'=>'YES', 'label'=>'Number');
	public $paper_date = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Date');
	public $paper_price = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Price');
	public $bank_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Bank', 'foreign'=>'banks@id!bank_title');
	public $paper_holder = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Holder');
	public $paper_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $paper_status = array('type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', 'null'=>'YES', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function paper_type() 
	{
		$this->form("select")->name("type")->type("select")->maxlength(50)->validate();
		$this->setChild($this->form);
	}
	public function paper_number() 
	{
		$this->form("text")->name("number")->maxlength(20)->type('text');
	}
	public function paper_date() 
	{
		$this->form("text")->name("date");
	}
	public function paper_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("select")->name("bank")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function paper_holder() 
	{
		$this->form("text")->name("holder")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ description
	public function paper_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function paper_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>