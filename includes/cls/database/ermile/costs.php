<?php
namespace database\ermile;
class costs 
{
	public $id            = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $cost_title    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@50'];
	public $cost_price    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4'];
	public $costcat_id    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'costcat'         ,'type'=>'smallint@5'                      ,'foreign'=>'costcats@id!id'];
	public $account_id    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'account'         ,'type'=>'smallint@5'                      ,'foreign'=>'accounts@id!id'];
	public $cost_date     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'date'            ,'type'=>'datetime@'];
	public $cost_desc     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@200'];
	public $cost_type     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@income,outcome!outcome'];
	public $paper_id      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'paper'           ,'type'=>'int@10'                          ,'foreign'=>'papers@id!id'];
	public $date_modified = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function cost_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('50')->required();
	}

	public function cost_price()
	{
		$this->form()->type('number')->name('price')->max('9999999999999')->required();
	}
	//--------------------------------------------------------------------------------foreign
	public function costcat_id()
	{
		$this->form()->type('select')->name('costcat_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function account_id()
	{
		$this->form()->type('select')->name('account_')->required();
		$this->setChild();
	}

	public function cost_date()
	{
		$this->form()->type('text')->name('date')->required();
	}

	public function cost_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('200');
	}

	public function cost_type()
	{
		$this->form()->type('radio')->name('type')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function paper_id()
	{
		$this->form()->type('select')->name('paper_');
		$this->setChild();
	}

	public function date_modified(){}
}
?>