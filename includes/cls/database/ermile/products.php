<?php
namespace database\ermile;
class products 
{
	public $id                     = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                                                      );
	public $product_title          = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@100',                                                     );
	public $product_slug           = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@50',                                                      );
	public $productcat_id          = array('null' =>'NO',  'show' =>'YES', 'label'=>'productcat',    'type' => 'smallint@5!1',                                                    'foreign'=>'productcats@id!productcat_title');
	public $product_barcode        = array('null' =>'YES', 'show' =>'YES', 'label'=>'barcode',       'type' => 'varchar@20',                                                      );
	public $product_barcode2       = array('null' =>'YES', 'show' =>'YES', 'label'=>'barcode2',      'type' => 'varchar@20',                                                      );
	public $product_buyprice       = array('null' =>'YES', 'show' =>'YES', 'label'=>'buyprice',      'type' => 'decimal@13,4',                                                    );
	public $product_price          = array('null' =>'NO',  'show' =>'YES', 'label'=>'price',         'type' => 'decimal@13,4',                                                    );
	public $product_discount       = array('null' =>'YES', 'show' =>'YES', 'label'=>'discount',      'type' => 'decimal@13,4',                                                    );
	public $product_vat            = array('null' =>'YES', 'show' =>'YES', 'label'=>'vat',           'type' => 'decimal@6,4',                                                     );
	public $product_initialbalance = array('null' =>'YES', 'show' =>'YES', 'label'=>'initialbalance','type' => 'int@10',                                                          );
	public $product_mininventory   = array('null' =>'YES', 'show' =>'YES', 'label'=>'mininventory',  'type' => 'int@10',                                                          );
	public $product_status         = array('null' =>'YES', 'show' =>'YES', 'label'=>'status',        'type' => 'enum@unset,available,soon,discontinued,unavailable,expire!unset', );
	public $product_sold           = array('null' =>'YES', 'show' =>'YES', 'label'=>'sold',          'type' => 'int@10',                                                          );
	public $product_stock          = array('null' =>'YES', 'show' =>'YES', 'label'=>'stock',         'type' => 'int@10',                                                          );
	public $product_carton         = array('null' =>'YES', 'show' =>'YES', 'label'=>'carton',        'type' => 'int@10',                                                          );
	public $attachment_id          = array('null' =>'YES', 'show' =>'YES', 'label'=>'attachment',    'type' => 'int@10',                                                          'foreign'=>'attachments@id!attachment_title');
	public $product_service        = array('null' =>'NO',  'show' =>'YES', 'label'=>'service',       'type' => 'enum@yes,no!no',                                                  );
	public $product_sellin         = array('null' =>'NO',  'show' =>'YES', 'label'=>'sellin',        'type' => 'enum@store,online,both!both',                                     );
	public $date_modified          = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                                      );


	//------------------------------------------------------------------ id
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
		$this->form("select")->name("productcat_")->min(0)->max(99999)->required()->type("select")->validate()->id();
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
		$this->form("text")->name("buyprice")->max(9999999999999)->type('number');
	}
	public function product_price() 
	{
		$this->form("text")->name("price")->max(9999999999999)->required()->type('number');
	}
	public function product_discount() 
	{
		$this->form("text")->name("discount")->max(9999999999999)->type('number');
	}
	public function product_vat() 
	{
		$this->form("text")->name("vat")->max(999999)->type('number');
	}
	public function product_initialbalance() 
	{
		$this->form("text")->name("initialbalance")->max(9999999999)->type('number');
	}
	public function product_mininventory() 
	{
		$this->form("text")->name("mininventory")->max(9999999999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function product_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild();
	}
	public function product_sold() 
	{
		$this->form("text")->name("sold")->max(9999999999)->type('number');
	}
	public function product_stock() 
	{
		$this->form("text")->name("stock")->max(9999999999)->type('number');
	}
	public function product_carton() 
	{
		$this->form("text")->name("carton")->max(9999999999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment_")->min(0)->max(9999999999)->type("select")->validate()->id();
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