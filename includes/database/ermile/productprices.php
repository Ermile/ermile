<?php
namespace database\ermile;
class productprices 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $product_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Product', 'foreign'=>'products@id!product_title');
	public $productmeta_id = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Productmeta', 'foreign'=>'productmetas@id!productmeta_title');
	public $productprice_cat = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Cat');
	public $productprice_startdate = array('type' => 'datetime@', 'null'=>'NO', 'show'=>'YES', 'label'=>'Startdate');
	public $productprice_enddate = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Enddate');
	public $productprice_buyprice = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Buyprice');
	public $productprice_price = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Price');
	public $productprice_discount = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Discount');
	public $productprice_vat = array('type' => 'decimal@6,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Vat');
	public $productprice_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function productmeta_id() 
	{
		$this->form("select")->name("productmeta")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild($this->form);
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
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>