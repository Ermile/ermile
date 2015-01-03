<?php
namespace database\ermile;
class products 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $product_title = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $product_slug = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $productcat_id = array('type' => 'smallint@5!1', 'null'=>'NO', 'show'=>'YES', 'label'=>'Productcat', 'foreign'=>'productcats@id!productcat_title');
	public $product_barcode = array('type' => 'varchar@20', 'null'=>'YES', 'show'=>'YES', 'label'=>'Barcode');
	public $product_barcode2 = array('type' => 'varchar@20', 'null'=>'YES', 'show'=>'YES', 'label'=>'Barcode2');
	public $product_buyprice = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Buyprice');
	public $product_price = array('type' => 'decimal@13,4', 'null'=>'NO', 'show'=>'YES', 'label'=>'Price');
	public $product_discount = array('type' => 'decimal@13,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Discount');
	public $product_vat = array('type' => 'decimal@6,4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Vat');
	public $product_initialbalance = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Initialbalance');
	public $product_mininventory = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Mininventory');
	public $product_status = array('type' => 'enum@unset,available,soon,discontinued,unavailable,expire!unset', 'null'=>'YES', 'show'=>'YES', 'label'=>'Status');
	public $product_sold = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Sold');
	public $product_stock = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Stock');
	public $product_carton = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Carton');
	public $attachment_id = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Attachment', 'foreign'=>'attachments@id!attachment_title');
	public $product_service = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Service');
	public $product_sellin = array('type' => 'enum@store,online,both!both', 'null'=>'NO', 'show'=>'YES', 'label'=>'Sellin');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function product_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function product_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("product_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function productcat_id() 
	{
		$this->form("select")->name("productcat")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function product_barcode() 
	{
		$this->form("text")->name("barcode")->maxlength(20)->type('text');
	}
	public function product_barcode2() 
	{
		$this->form("text")->name("barcode2")->maxlength(20)->type('text');
	}
	public function product_buyprice() 
	{
		$this->form("text")->name("buyprice")->max(999999999999)->type('number');
	}
	public function product_price() 
	{
		$this->form("text")->name("price")->max(999999999999)->required()->type('number');
	}
	public function product_discount() 
	{
		$this->form("text")->name("discount")->max(999999999999)->type('number');
	}
	public function product_vat() 
	{
		$this->form("text")->name("vat")->max(99999)->type('number');
	}
	public function product_initialbalance() 
	{
		$this->form("text")->name("initialbalance")->max(999999999)->type('number');
	}
	public function product_mininventory() 
	{
		$this->form("text")->name("mininventory")->max(999999999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function product_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function product_sold() 
	{
		$this->form("text")->name("sold")->max(999999999)->type('number');
	}
	public function product_stock() 
	{
		$this->form("text")->name("stock")->max(999999999)->type('number');
	}
	public function product_carton() 
	{
		$this->form("text")->name("carton")->max(999999999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function product_service() 
	{
		$this->form("radio")->name("service")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function product_sellin() 
	{
		$this->form("select")->name("sellin")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>