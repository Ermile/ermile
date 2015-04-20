<?php
namespace database\ermile;
class termusages 
{
	public $term_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'term',          'type' => 'int@10',                                   'foreign'=>'terms@id!term_title');
	public $object_id       = array('null' =>'NO',  'show' =>'YES', 'label'=>'object',        'type' => 'bigint@20',                                'foreign'=>'objects@id!object_title');
	public $termusage_type  = array('null' =>'YES', 'show' =>'YES', 'label'=>'type',          'type' => 'enum@posts,products,attachments,comments', );
	public $termusage_order = array('null' =>'YES', 'show' =>'YES', 'label'=>'order',         'type' => 'smallint@5',                               );


	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("select")->name("term_")->min(0)->max(9999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function object_id() 
	{
		$this->form("select")->name("object_")->min(0)->max(99999999999999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function termusage_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild();
	}
	public function termusage_order() 
	{
		$this->form("text")->name("order")->min(0)->max(99999)->type('number');
	}
}
?>