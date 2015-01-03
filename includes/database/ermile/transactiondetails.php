<?php
namespace database\ermile;
class transactiondetails 
{
	public $transactiondetail_row = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Row');
	public $transaction_id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Transaction', 'foreign'=>'transactions@id!id');
	public $product_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Product', 'foreign'=>'products@id!product_title');
	public $transactiondetail_quantity = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Quantity');
	public $transactiondetail_price = array('type' => 'decimal@13,4', 'null'=>'NO', 'show'=>'YES', 'label'=>'Price');
	public $transactiondetail_discount = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Discount');

	public function transactiondetail_row() 
	{
		$this->form("text")->name("row")->min(0)->max(9999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function transactiondetail_quantity() 
	{
		$this->form("text")->name("quantity")->max(999999999)->required()->type('number');
	}
	public function transactiondetail_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->required()->type('number');
	}
	public function transactiondetail_discount() 
	{
		$this->form("text")->name("discount")->max(999999999999)->type('number');
	}
}
?>