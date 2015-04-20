<?php
namespace database\ermile;
class transactiondetails 
{
	public $transactiondetail_row      = array('null' =>'YES', 'show' =>'YES', 'label'=>'row',           'type' => 'smallint@5',   );
	public $transaction_id             = array('null' =>'NO',  'show' =>'YES', 'label'=>'transaction',   'type' => 'bigint@20',    'foreign'=>'transactions@id!id');
	public $product_id                 = array('null' =>'NO',  'show' =>'YES', 'label'=>'product',       'type' => 'int@10',       'foreign'=>'products@id!product_title');
	public $transactiondetail_quantity = array('null' =>'NO',  'show' =>'YES', 'label'=>'quantity',      'type' => 'int@10',       );
	public $transactiondetail_price    = array('null' =>'NO',  'show' =>'YES', 'label'=>'price',         'type' => 'decimal@13,4', );
	public $transactiondetail_discount = array('null' =>'YES', 'show' =>'YES', 'label'=>'discount',      'type' => 'decimal@13,4', );

	public function transactiondetail_row() 
	{
		$this->form("text")->name("row")->min(0)->max(99999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction_")->min(0)->max(99999999999999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product_")->min(0)->max(9999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function transactiondetail_quantity() 
	{
		$this->form("text")->name("quantity")->max(9999999999)->required()->type('number');
	}
	public function transactiondetail_price() 
	{
		$this->form("text")->name("price")->max(9999999999999)->required()->type('number');
	}
	public function transactiondetail_discount() 
	{
		$this->form("text")->name("discount")->max(9999999999999)->type('number');
	}
}
?>