<?php
namespace database\ermile;
class terms 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                            );
	public $term_language = array('null' =>'YES', 'show' =>'YES', 'label'=>'language',      'type' => 'char@2',                            );
	public $term_cat      = array('null' =>'NO',  'show' =>'YES', 'label'=>'cat',           'type' => 'varchar@50',                        );
	public $term_title    = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@50',                        );
	public $term_slug     = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@50',                        );
	public $term_desc     = array('null' =>'NO',  'show' =>'NO',  'label'=>'desc',          'type' => 'text@',                             );
	public $term_parent   = array('null' =>'YES', 'show' =>'YES', 'label'=>'parent',        'type' => 'int@10',                            );
	public $term_count    = array('null' =>'YES', 'show' =>'YES', 'label'=>'count',         'type' => 'smallint@5',                        );
	public $term_status   = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}
	public function term_language() 
	{
		$this->form("text")->name("language")->maxlength(2)->type('text');
	}
	public function term_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
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
		$this->form("#desc")->required();
	}
	public function term_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(9999999999)->type('number');
	}
	public function term_count() 
	{
		$this->form("text")->name("count")->min(0)->max(99999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function term_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>