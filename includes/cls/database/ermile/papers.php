<?php
namespace database\ermile;
class papers 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                                               );
	public $paper_type    = array('null' =>'YES', 'show' =>'YES', 'label'=>'type',          'type' => 'varchar@50',                                           );
	public $paper_number  = array('null' =>'YES', 'show' =>'YES', 'label'=>'number',        'type' => 'varchar@20',                                           );
	public $paper_date    = array('null' =>'YES', 'show' =>'YES', 'label'=>'date',          'type' => 'datetime@',                                            );
	public $paper_price   = array('null' =>'YES', 'show' =>'YES', 'label'=>'price',         'type' => 'decimal@13,4',                                         );
	public $bank_id       = array('null' =>'NO',  'show' =>'YES', 'label'=>'bank',          'type' => 'smallint@5',                                           'foreign'=>'banks@id!bank_title');
	public $paper_holder  = array('null' =>'YES', 'show' =>'YES', 'label'=>'holder',        'type' => 'varchar@100',                                          );
	public $paper_desc    = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                                          );
	public $paper_status  = array('null' =>'YES', 'show' =>'YES', 'label'=>'status',        'type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                           );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function paper_type() 
	{
		$this->form("select")->name("type")->type("select")->maxlength(50)->validate();
		$this->setChild();
	}
	public function paper_number() 
	{
		$this->form("text")->name("number")->maxlength(20)->type('text');
	}
	public function paper_date() 
	{
		$this->form("text")->name("date");
	}
	public function paper_price() 
	{
		$this->form("text")->name("price")->max(9999999999999)->type('number');
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("select")->name("bank_")->min(0)->max(99999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function paper_holder() 
	{
		$this->form("text")->name("holder")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ desc
	public function paper_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function paper_status() 
	{
		$this->form("select")->name("status")->type("select")->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>