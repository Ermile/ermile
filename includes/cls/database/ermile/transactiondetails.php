<?php
namespace database\ermile;
class transactiondetails 
{
	public $transactiondetail_row      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'row'             ,'type'=>'smallint@5'];
	public $transaction_id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'transaction'     ,'type'=>'bigint@20'                       ,'foreign'=>'transactions@id!id'];
	public $product_id                 = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'product'         ,'type'=>'int@10'                          ,'foreign'=>'products@id!product_title'];
	public $transactiondetail_quantity = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'quantity'        ,'type'=>'int@10'];
	public $transactiondetail_price    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4'];
	public $transactiondetail_discount = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'discount'        ,'type'=>'decimal@13,4'];


	public function transactiondetail_row()
	{
		$this->form()->type('number')->name('row')->min()->max('99999');
	}
	//--------------------------------------------------------------------------------foreign
	public function transaction_id()
	{
		$this->form()->type('select')->name('transaction_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function product_id()
	{
		$this->form()->type('select')->name('product_')->required();
		$this->setChild();
	}

	public function transactiondetail_quantity()
	{
		$this->form()->type('number')->name('quantity')->max('9999999999')->required();
	}

	public function transactiondetail_price()
	{
		$this->form()->type('number')->name('price')->max('9999999999999')->required();
	}

	public function transactiondetail_discount()
	{
		$this->form()->type('number')->name('discount')->max('9999999999999');
	}
}
?>