<?php
namespace database\ermile;
class banks 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                        );
	public $bank_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@50',                        );
	public $bank_slug     = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@50',                        );
	public $bank_website  = array('null' =>'YES', 'show' =>'NO',  'label'=>'website',       'type' => 'varchar@50',                        );
	public $bank_status   = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function bank_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function bank_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ website
	public function bank_website() 
	{
		$this->form("#website")->maxlength(50)->type('url');
	}

	//------------------------------------------------------------------ select button
	public function bank_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>