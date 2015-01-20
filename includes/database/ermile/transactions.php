<?php
namespace database\ermile;
class transactions 
{
	public $id                   = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                                                                                            );
	public $transaction_type     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Type',          'type' => 'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale', );
	public $user_id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                                                                        'foreign'=>'users@id!user_nickname');
	public $user_id_customer     = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                                                                        'foreign'=>'users@id!user_nickname');
	public $transaction_date     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Date',          'type' => 'datetime@',                                                                                         );
	public $transaction_sum      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Sum',           'type' => 'decimal@13,4',                                                                                      );
	public $transaction_remained = array('null' =>'YES', 'show' =>'YES', 'label'=>'Remained',      'type' => 'decimal@13,4',                                                                                      );
	public $date_modified        = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                                                                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function transaction_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_id_customer() 
	{
		$this->form("select")->name("user_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function transaction_date() 
	{
		$this->form("text")->name("date")->required();
	}
	public function transaction_sum() 
	{
		$this->form("text")->name("sum")->max(999999999999)->required()->type('number');
	}
	public function transaction_remained() 
	{
		$this->form("text")->name("remained")->max(999999999999)->type('number');
	}
	public function date_modified() {}
}
?>