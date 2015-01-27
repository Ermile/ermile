<?php
namespace database\ermile;
class terms 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                        );
	public $term_language = array('null' =>'YES', 'show' =>'YES', 'label'=>'Language',      'type' => 'char@2',                            );
	public $term_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                        );
	public $term_slug     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@50',                        );
	public $term_desc     = array('null' =>'NO',  'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',                       );
	public $term_parent   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Parent',        'type' => 'smallint@5',                        );
	public $term_type     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Type',          'type' => 'enum@cat,tag!cat',                  );
	public $term_status   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $term_count    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Count',         'type' => 'smallint@5',                        );
	public $term_order    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Order',         'type' => 'smallint@5',                        );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function term_language() 
	{
		$this->form("text")->name("language")->maxlength(2)->type('text');
	}

	//------------------------------------------------------------------ title
	public function term_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function term_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ desc
	public function term_desc() 
	{
		$this->form("#desc")->maxlength(200)->required()->type('textarea');
	}
	public function term_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(9999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function term_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function term_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function term_count() 
	{
		$this->form("text")->name("count")->min(0)->max(9999)->type('number');
	}
	public function term_order() 
	{
		$this->form("text")->name("order")->min(0)->max(9999)->type('number');
	}
	public function date_modified() {}
}
?>