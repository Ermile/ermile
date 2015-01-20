<?php
namespace database\ermile;
class productprices 
{
	public $id                     = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                            );
	public $product_id             = array('null' =>'NO',  'show' =>'YES', 'label'=>'Product',       'type' => 'smallint@5',                        'foreign'=>'products@id!product_title');
	public $productmeta_id         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Productmeta',   'type' => 'int@10',                            'foreign'=>'productmetas@id!productmeta_title');
	public $productprice_cat       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $productprice_startdate = array('null' =>'NO',  'show' =>'YES', 'label'=>'Startdate',     'type' => 'datetime@',                         );
	public $productprice_enddate   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Enddate',       'type' => 'datetime@',                         );
	public $productprice_buyprice  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Buyprice',      'type' => 'decimal@13,4',                      );
	public $productprice_price     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Price',         'type' => 'decimal@13,4',                      );
	public $productprice_discount  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Discount',      'type' => 'decimal@13,4',                      );
	public $productprice_vat       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Vat',           'type' => 'decimal@6,4',                       );
	public $productprice_status    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified          = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function productmeta_id() 
	{
		$this->form("select")->name("productmeta_")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function productprice_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->type('text');
	}
	public function productprice_startdate() 
	{
		$this->form("text")->name("startdate")->required();
	}
	public function productprice_enddate() 
	{
		$this->form("text")->name("enddate");
	}
	public function productprice_buyprice() 
	{
		$this->form("text")->name("buyprice")->max(999999999999)->type('number');
	}
	public function productprice_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->type('number');
	}
	public function productprice_discount() 
	{
		$this->form("text")->name("discount")->max(999999999999)->type('number');
	}
	public function productprice_vat() 
	{
		$this->form("text")->name("vat")->max(99999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function productprice_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>