<?php
namespace database\ermile;
class papers 
{
	public $id            = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $paper_type    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'varchar@50'];
	public $paper_number  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'number'          ,'type'=>'varchar@20'];
	public $paper_date    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'date'            ,'type'=>'datetime@'];
	public $paper_price   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'price'           ,'type'=>'decimal@13,4'];
	public $bank_id       = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'bank'            ,'type'=>'smallint@5'                      ,'foreign'=>'banks@id!id'];
	public $paper_holder  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'holder'          ,'type'=>'varchar@100'];
	public $paper_desc    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@200'];
	public $paper_status  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@pass,recovery,fail,lost,block,delete,inprogress'];
	public $date_modified = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function paper_type()
	{
		$this->form()->type('text')->name('type')->maxlength('50');
	}

	public function paper_number()
	{
		$this->form()->type('text')->name('number')->maxlength('20');
	}

	public function paper_date()
	{
		$this->form()->type('text')->name('date');
	}

	public function paper_price()
	{
		$this->form()->type('number')->name('price')->max('9999999999999');
	}
	//--------------------------------------------------------------------------------foreign
	public function bank_id()
	{
		$this->form()->type('select')->name('bank_')->required();
		$this->setChild();
	}

	public function paper_holder()
	{
		$this->form()->type('text')->name('holder')->maxlength('100');
	}

	public function paper_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('200');
	}

	public function paper_status()
	{
		$this->form()->type('radio')->name('status');
		$this->setChild();
	}

	public function date_modified(){}
}
?>