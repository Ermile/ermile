<?php
namespace database\ermile;
class receipts 
{
	public $id                  = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $receipt_code        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'code'            ,'type'=>'varchar@30'];
	public $receipt_type        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@income,outcome!income'];
	public $receipt_price       = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4!0.0000'];
	public $receipt_date        = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'date'            ,'type'=>'datetime@'];
	public $paper_id            = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'paper'           ,'type'=>'int@10'                          ,'foreign'=>'papers@id!id'];
	public $receipt_paperdate   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'paperdate'       ,'type'=>'datetime@'];
	public $receipt_paperstatus = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'paperstatus'     ,'type'=>'enum@pass,recovery,fail,lost,block,delete,inprogress'];
	public $receipt_desc        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@200'];
	public $transaction_id      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'transaction'     ,'type'=>'bigint@20'                       ,'foreign'=>'transactions@id!id'];
	public $fund_id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'fund'            ,'type'=>'smallint@5'                      ,'foreign'=>'funds@id!id'];
	public $user_id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $user_idcustomer     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user customer'   ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_custome_displayname'];
	public $date_modified       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];
	public $account_id          = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'account'         ,'type'=>'smallint@5'                      ,'foreign'=>'accounts@id!id'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function receipt_code()
	{
		$this->form()->type('text')->name('code')->maxlength('30');
	}

	public function receipt_type()
	{
		$this->form()->type('radio')->name('type');
		$this->setChild();
	}

	public function receipt_price()
	{
		$this->form()->type('number')->name('price')->max('9999999999999')->required();
	}

	public function receipt_date()
	{
		$this->form()->type('text')->name('date')->required();
	}
	//--------------------------------------------------------------------------------foreign
	public function paper_id()
	{
		$this->form()->type('select')->name('paper_');
		$this->setChild();
	}

	public function receipt_paperdate()
	{
		$this->form()->type('text')->name('paperdate');
	}

	public function receipt_paperstatus()
	{
		$this->form()->type('radio')->name('paperstatus');
		$this->setChild();
	}

	public function receipt_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('200');
	}
	//--------------------------------------------------------------------------------foreign
	public function transaction_id()
	{
		$this->form()->type('select')->name('transaction_');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function fund_id()
	{
		$this->form()->type('select')->name('fund_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_idcustomer()
	{
		$this->form()->type('select')->name('user_customer')->required();
		$this->setChild();
	}

	public function date_modified(){}
	//--------------------------------------------------------------------------------foreign
	public function account_id()
	{
		$this->form()->type('select')->name('account_')->required();
		$this->setChild();
	}
}
?>