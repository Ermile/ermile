<?php
namespace database\ermile;
class products 
{
	public $id                     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $product_title          = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@100'];
	public $product_slug           = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'slug'            ,'type'=>'varchar@50'];
	public $product_barcode        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'barcode'         ,'type'=>'varchar@20'];
	public $product_barcode2       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'barcode2'        ,'type'=>'varchar@20'];
	public $product_buyprice       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'buyprice'        ,'type'=>'decimal@13,4'];
	public $product_price          = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4'];
	public $product_discount       = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'discount'        ,'type'=>'decimal@13,4'];
	public $product_vat            = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'vat'             ,'type'=>'decimal@6,4'];
	public $product_initialbalance = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'initialbalance'  ,'type'=>'int@10'];
	public $product_mininventory   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'mininventory'    ,'type'=>'int@10'];
	public $product_status         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@unset,available,soon,discontinued,unavailable,expire!unset'];
	public $product_sold           = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'sold'            ,'type'=>'int@10'];
	public $product_stock          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'stock'           ,'type'=>'int@10'];
	public $product_carton         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'carton'          ,'type'=>'int@10'];
	public $product_service        = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'service'         ,'type'=>'enum@yes,no!no'];
	public $product_sellin         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'sellin'          ,'type'=>'enum@store,online,both!both'];
	public $date_modified          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function product_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('100')->required();
	}

	public function product_slug()
	{
		$this->form('#slug')->type('text')->name('slug')->maxlength('50')->required();
	}

	public function product_barcode()
	{
		$this->form()->type('text')->name('barcode')->maxlength('20');
	}

	public function product_barcode2()
	{
		$this->form()->type('text')->name('barcode2')->maxlength('20');
	}

	public function product_buyprice()
	{
		$this->form()->type('number')->name('buyprice')->min()->max('9999999999999');
	}

	public function product_price()
	{
		$this->form()->type('number')->name('price')->min()->max('9999999999999')->required();
	}

	public function product_discount()
	{
		$this->form()->type('number')->name('discount')->max('9999999999999');
	}

	public function product_vat()
	{
		$this->form()->type('number')->name('vat')->min()->max('999999');
	}

	public function product_initialbalance()
	{
		$this->form()->type('number')->name('initialbalance')->max('9999999999');
	}

	public function product_mininventory()
	{
		$this->form()->type('number')->name('mininventory')->min()->max('9999999999');
	}

	public function product_status()
	{
		$this->form()->type('radio')->name('status');
		$this->setChild();
	}

	public function product_sold()
	{
		$this->form()->type('number')->name('sold')->max('9999999999');
	}

	public function product_stock()
	{
		$this->form()->type('number')->name('stock')->max('9999999999');
	}

	public function product_carton()
	{
		$this->form()->type('number')->name('carton')->min()->max('9999999999');
	}

	public function product_service()
	{
		$this->form()->type('radio')->name('service')->required();
		$this->setChild();
	}

	public function product_sellin()
	{
		$this->form()->type('radio')->name('sellin')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>