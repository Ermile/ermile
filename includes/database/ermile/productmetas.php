<?php
namespace database\ermile;
class productmetas 
{
	public $id                 = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'int@10',                            );
	public $product_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Product',       'type' => 'smallint@5',                        'foreign'=>'products@id!product_title');
	public $productmeta_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $productmeta_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@100',                       );
	public $productmeta_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Value',         'type' => 'varchar@999',                       );
	public $productmeta_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified      = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function productmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function productmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function productmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function productmeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>