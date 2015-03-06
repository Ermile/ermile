<?php
namespace database\ermile;
class locations 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                        );
	public $location_title  = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@100',                       );
	public $location_slug   = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@100',                       );
	public $location_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                       );
	public $location_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form("#slug")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ desc
	public function location_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function location_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>