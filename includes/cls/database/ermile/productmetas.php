<?php
namespace database\ermile;
class productmetas 
{
	public $id                 = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $product_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'product'         ,'type'=>'int@10'                          ,'foreign'=>'products@id!id'];
	public $productmeta_cat    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $productmeta_key    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'key'             ,'type'=>'varchar@100'];
	public $productmeta_value  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@999'];
	public $productmeta_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function product_id()
	{
		$this->form()->type('select')->name('product_')->required();
		$this->setChild();
	}

	public function productmeta_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50')->required();
	}

	public function productmeta_key()
	{
		$this->form()->type('text')->name('key')->maxlength('100')->required();
	}

	public function productmeta_value()
	{
		$this->form()->type('textarea')->name('value')->maxlength('999');
	}

	public function productmeta_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>