<?php
namespace database\ermile;
class receipts 
{
	public $id                  = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                                               );
	public $receipt_code        = array('null' =>'YES', 'show' =>'YES', 'label'=>'Code',          'type' => 'varchar@30',                                           );
	public $receipt_type        = array('null' =>'YES', 'show' =>'YES', 'label'=>'Type',          'type' => 'enum@income,outcome!income',                           );
	public $receipt_price       = array('null' =>'NO',  'show' =>'YES', 'label'=>'Price',         'type' => 'decimal@13,4!0.0000',                                  );
	public $receipt_date        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Date',          'type' => 'datetime@',                                            );
	public $paper_id            = array('null' =>'YES', 'show' =>'YES', 'label'=>'Paper',         'type' => 'smallint@5',                                           'foreign'=>'papers@id!id');
	public $receipt_paperdate   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Paperdate',     'type' => 'datetime@',                                            );
	public $receipt_paperstatus = array('null' =>'YES', 'show' =>'YES', 'label'=>'Paperstatus',   'type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', );
	public $receipt_desc        = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',                                          );
	public $transaction_id      = array('null' =>'YES', 'show' =>'YES', 'label'=>'Transaction',   'type' => 'int@10',                                               'foreign'=>'transactions@id!id');
	public $fund_id             = array('null' =>'NO',  'show' =>'YES', 'label'=>'Fund',          'type' => 'smallint@5',                                           'foreign'=>'funds@id!fund_title');
	public $user_id             = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                           'foreign'=>'users@id!user_nickname');
	public $user_id_customer    = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                           'foreign'=>'users@id!user_nickname');
	public $date_modified       = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                           );


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
		$this->setChild();
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
		$this->form("select")->name("paper_")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function receipt_paperdate() 
	{
		$this->form("text")->name("paperdate");
	}

	//------------------------------------------------------------------ select button
	public function receipt_paperstatus() 
	{
		$this->form("select")->name("paperstatus")->type("select")->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ desc
	public function receipt_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction_")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->form("select")->name("fund_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_id_customer() 
	{
		$this->form("select")->name("user_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>