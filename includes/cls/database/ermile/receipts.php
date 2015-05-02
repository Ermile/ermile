<?php
namespace database\ermile;
class receipts 
{
	public $id                  = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'bigint@20',                                            );
	public $receipt_code        = array('null' =>'YES', 'show' =>'YES', 'label'=>'code',          'type' => 'varchar@30',                                           );
	public $receipt_type        = array('null' =>'YES', 'show' =>'YES', 'label'=>'type',          'type' => 'enum@income,outcome!income',                           );
	public $receipt_price       = array('null' =>'NO',  'show' =>'YES', 'label'=>'price',         'type' => 'decimal@13,4!0.0000',                                  );
	public $receipt_date        = array('null' =>'NO',  'show' =>'YES', 'label'=>'date',          'type' => 'datetime@',                                            );
	public $paper_id            = array('null' =>'YES', 'show' =>'YES', 'label'=>'paper',         'type' => 'int@10',                                               'foreign'=>'papers@id!id');
	public $receipt_paperdate   = array('null' =>'YES', 'show' =>'YES', 'label'=>'paperdate',     'type' => 'datetime@',                                            );
	public $receipt_paperstatus = array('null' =>'YES', 'show' =>'YES', 'label'=>'paperstatus',   'type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', );
	public $receipt_desc        = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                                          );
	public $transaction_id      = array('null' =>'YES', 'show' =>'YES', 'label'=>'transaction',   'type' => 'bigint@20',                                            'foreign'=>'transactions@id!id');
	public $fund_id             = array('null' =>'NO',  'show' =>'YES', 'label'=>'fund',          'type' => 'smallint@5',                                           'foreign'=>'funds@id!fund_title');
	public $user_id             = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'int@10',                                               'foreign'=>'users@id!user_nickname');
	public $user_idcustomer     = array('null' =>'NO',  'show' =>'NO',  'label'=>'user customer', 'type' => 'int@10',                                               'foreign'=>'users@id!user_nickname');
	public $date_modified       = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                           );
	public $account_id          = array('null' =>'NO',  'show' =>'YES', 'label'=>'account',       'type' => 'smallint@5',                                           'foreign'=>'accounts@id!account_title');


	//------------------------------------------------------------------ id
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
		$this->form("text")->name("price")->max(9999999999999)->required()->type('number');
	}
	public function receipt_date() 
	{
		$this->form("text")->name("date")->required()->type('text');
	}

	//------------------------------------------------------------------ id - foreign key
	public function paper_id() 
	{
		$this->form("select")->name("paper_")->min(0)->max(9999999999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function receipt_paperdate() 
	{
		$this->form("text")->name("paperdate")->type('text');
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
		$this->form("select")->name("transaction_")->min(0)->max(99999999999999999999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->form("select")->name("fund_")->min(0)->max(99999)->required()->type("select")->validate()->id();
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
	public function date_modified() {}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("select")->name("account_")->min(0)->max(99999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
}
?>