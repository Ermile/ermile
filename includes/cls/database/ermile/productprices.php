<?php
namespace database\ermile;
class productprices 
{
	public $id                     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $product_id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'product'         ,'type'=>'int@10'                          ,'foreign'=>'products@id!product_title'];
	public $productmeta_id         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'productmeta'     ,'type'=>'int@10'                          ,'foreign'=>'productmetas@id!productmeta_title'];
	public $productprice_cat       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $productprice_startdate = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'startdate'       ,'type'=>'datetime@'];
	public $productprice_enddate   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'enddate'         ,'type'=>'datetime@'];
	public $productprice_buyprice  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'buyprice'        ,'type'=>'decimal@13,4'];
	public $productprice_price     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4'];
	public $productprice_discount  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'discount'        ,'type'=>'decimal@13,4'];
	public $productprice_vat       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'vat'             ,'type'=>'decimal@6,4'];
	public $productprice_status    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function product_id()
	{
		$this->form()->type('select')->name('product_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function productmeta_id()
	{
		$this->form()->type('select')->name('productmeta_');
		$this->setChild();
	}

	public function productprice_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50');
	}

	public function productprice_startdate()
	{
		$this->form()->type('text')->name('startdate')->required();
	}

	public function productprice_enddate()
	{
		$this->form()->type('text')->name('enddate');
	}

	public function productprice_buyprice()
	{
		$this->form()->type('number')->name('buyprice')->max('9999999999999');
	}

	public function productprice_price()
	{
		$this->form()->type('number')->name('price')->max('9999999999999');
	}

	public function productprice_discount()
	{
		$this->form()->type('number')->name('discount')->max('9999999999999');
	}

	public function productprice_vat()
	{
		$this->form()->type('number')->name('vat')->max('999999');
	}

	public function productprice_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>