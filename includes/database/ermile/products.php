<?php
namespace database\ermile;
class products 
{
	public $id                     = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                                                      );
	public $product_title          = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',                                                     );
	public $product_slug           = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@50',                                                      );
	public $productcat_id          = array('null' =>'NO',  'show' =>'YES', 'label'=>'Productcat',    'type' => 'smallint@5!1',                                                    'foreign'=>'productcats@id!productcat_title');
	public $product_barcode        = array('null' =>'YES', 'show' =>'YES', 'label'=>'Barcode',       'type' => 'varchar@20',                                                      );
	public $product_barcode2       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Barcode2',      'type' => 'varchar@20',                                                      );
	public $product_buyprice       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Buyprice',      'type' => 'decimal@13,4',                                                    );
	public $product_price          = array('null' =>'NO',  'show' =>'YES', 'label'=>'Price',         'type' => 'decimal@13,4',                                                    );
	public $product_discount       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Discount',      'type' => 'decimal@13,4',                                                    );
	public $product_vat            = array('null' =>'YES', 'show' =>'YES', 'label'=>'Vat',           'type' => 'decimal@6,4',                                                     );
	public $product_initialbalance = array('null' =>'YES', 'show' =>'YES', 'label'=>'Initialbalance','type' => 'int@10',                                                          );
	public $product_mininventory   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Mininventory',  'type' => 'int@10',                                                          );
	public $product_status         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Status',        'type' => 'enum@unset,available,soon,discontinued,unavailable,expire!unset', );
	public $product_sold           = array('null' =>'YES', 'show' =>'YES', 'label'=>'Sold',          'type' => 'int@10',                                                          );
	public $product_stock          = array('null' =>'YES', 'show' =>'YES', 'label'=>'Stock',         'type' => 'int@10',                                                          );
	public $product_carton         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Carton',        'type' => 'int@10',                                                          );
	public $attachment_id          = array('null' =>'YES', 'show' =>'YES', 'label'=>'Attachment',    'type' => 'int@10',                                                          'foreign'=>'attachments@id!attachment_title');
	public $product_service        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Service',       'type' => 'enum@yes,no!no',                                                  );
	public $product_sellin         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Sellin',        'type' => 'enum@store,online,both!both',                                     );
	public $date_modified          = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                                      );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function product_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function product_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ id - foreign key
	public function productcat_id() 
	{
		$this->form("select")->name("productcat_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
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
		$this->setChild();
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
		$this->form("select")->name("attachment_")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function product_service() 
	{
		$this->form("radio")->name("service")->type("radio")->required();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function product_sellin() 
	{
		$this->form("select")->name("sellin")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>